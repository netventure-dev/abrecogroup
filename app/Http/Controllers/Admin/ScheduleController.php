<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ScheduleDataTable;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Schedule;
use App\Models\Bundle;
use App\Models\Rod;
use Excel;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(ScheduleDataTable $dataTable)
    {
        // $this->authorize('viewAny', Admin::class);
        $user = auth()->guard('admin')->user();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Schedule', route('admin.schedule.index')],
        ];
        return $dataTable->render('admin.schedule.index', ['user' => $user, 'breadcrumbs' =>$breadcrumbs]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Schedule', route('admin.schedule.index')],
            ['Create', route('admin.schedule.create')],
        ];
        return view('admin.schedule.create', compact('breadcrumbs'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {
        // $this->authorize('create', Admin::class);
        $validated = $this->validate($request, [
            'venue' => 'required',
            'speaker' => 'nullable',
            'topic' => 'nullable',
            'schedule_date' => 'nullable|date',
            'schedule_time' => 'nullable|date_format:g:i A',
            'status' => 'required',
        ]);
        $data = new Schedule();
        $data->venue = $validated['venue'];
        $data->speakers = $validated['speaker'];
        $data->topic = $validated['topic'];
        $data->schedule_date = date('Y-m-d', strtotime($validated['schedule_date']));
        $data->schedule_time = $validated['schedule_time'];
        $data->status = $validated['status'];
        $data->save();
        if ($data) {
            activity('admin')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created Schedule #' . $data->venue . '.');
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
    {
        $schedule = Schedule::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        // $roles = Role::all();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Schedule', route('admin.schedule.index')],
            [$schedule->name, null],
        ];
        return view('admin.schedule.edit', compact('schedule','breadcrumbs'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
    {
        $data = Schedule::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        $validated = $this->validate($request, [
            'venue' => 'required',
            'speaker' => 'nullable',
            'topic' => 'nullable',
            'schedule_date' => 'nullable|date',
            'schedule_time' => 'nullable|date_format:g:i A',
            'status' => 'required',
        ]);
        $data->venue = $validated['venue'];
        $data->speakers = $validated['speaker'];
        $data->topic = $validated['topic'];
        $data->schedule_date = date('Y-m-d', strtotime($validated['schedule_date']));
        $data->schedule_time = $validated['schedule_time'];
        $data->status = $validated['status'];
        $data->save();
        if ($data) {
            // $role = Role::findById($validated['role']);
            // $admin->assignRole($role);
            // $data['name'] = $admin->name;
            // $data['email'] = $admin->email;
            // $data['password'] = $validated['password'];
            // $data['url'] =  route('admin.login');
            // Notification::send($admin, new AdminAdd($data));
            activity('admin')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created Schedule #' . $data->venue . '.');
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $data = Schedule::whereid($id)->firstorFail();
        $res = $data->delete();
        if ($res) {
            activity('admin')->performedOn($data)->causedBy($data)->log('Deleted Schedule #' . $data->venue . '.');
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

    public function excel_store(Request $request)
    {
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'excel' => 'required|mimes:xlsx|max:2048',
        ]);
        $file = $request->file('excel');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize(); //Get size of uploaded file in bytes
            //Check for file extension and size
            $this->checkUploadedFileProperties($extension, $fileSize);
            //Where uploaded file will be stored on the server 
            $location = 'uploads'; //Created an "uploads" folder for that
            // Upload file
            $file->move($location, $filename);
            // In case the uploaded file path is to be stored in the database 
            $filepath = public_path($location . "/" . $filename);
            // Reading file
            $file = fopen($filepath, "r");
            $importData_arr = array(); // Read through the file and store the contents as an array
            $i = 0;
            //Read the contents of the uploaded file 
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);
                // Skip first row (Remove below comment if you want to skip the first row)
                if ($i == 0) {
                    $i++;
                    continue;
                }
                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file); //Close after reading
            $j = 0;
            // dd($importData_arr);
            $data=Excel::toArray([],$filepath);
            // dd($data);
            foreach ($data as $importDatas) {
                // try {   
                    // dd($importDatas);
                    foreach($importDatas as $key => $importData){
                        if($key != 0 && $importData[3] != null){
                            $data_exist=Schedule::where('topic',$importData[3])->first();
                            if($data_exist){
                                $data_exist->schedule_date  = isset($importData[0]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($importData[0]) : null;
                                $data_exist->schedule_time =isset($importData[1]) ? \Carbon\Carbon::parse(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($importData[1]))->format('h:i A') : null;
                                $data_exist->venue = $importData[2];
                                $data_exist->topic = $importData[3];
                                $data_exist->speakers = $importData[4];
                                $res = $data_exist->save(); 
                            }
                            else{
                                $data = new Schedule();
                                $data->schedule_date  = isset($importData[0]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($importData[0]) : null;
                                $data->schedule_time =isset($importData[1]) ? \Carbon\Carbon::parse(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($importData[1]))->format('h:i A') : null;
                                $data->venue = $importData[2];
                                $data->topic = $importData[3];
                                $data->speakers = $importData[4];
                                $res = $data->save();
                            }
                            
                        }
                        
                    }            
                   
                // } catch (\Exception $e) {
                // //throw $th;
                // DB::rollBack();
                // notify()->error(__('Failed to upload records. Please try again'));
                // return redirect()->back();
                // }
            }
            notify()->success(__('records successfully uploaded'));
            return redirect()->back();
        }
    }
    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
            } 
            else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        } 
        else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }

}
