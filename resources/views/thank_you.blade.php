@extends('layout.front_end')
@section('content')
<main  class="main-div">
    <section id="program-type" class="section">
        <div class="container mw-1640">
            <div class="row align-items-center mb-5">
                <div class="container section pb-0">
                    <div class="text-center">
                        <i class="fa fa-check text-yellow"  style="font-size: 50px;border-radius: 50px;background: #141414;padding: 15px;"></i>
                         <h1 class="text-center col-md-12">Thank You</h1>
                       
                         {{--  <p class="text-white mb-0"> Dear @if(isset(@$customer)) {{@$customer}} @else Customer @endif, <br>  --}}
                         @if(@$message) {{@$message}} @else
                            Thanks for reaching out! We have received your enquiry, our team will contact you as soon as possible. <br>
                            @endif
                           </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
