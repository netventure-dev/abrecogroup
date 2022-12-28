<!DOCTYPE html>
<html>

<body>

    <h2>Request-A-Rate</h2>

    <form action="{{ route('request-a-quote.store') }}" method="post" role="form" class="php-email-form" data-aos="fade-up" data-aos-delay="100">
        @csrf
        <label for="fname">First name:</label><br>
        <input type="text" id="name" name="name" value="{{ @old('name') }}"><br><br>
        <label for="lname">Phone Number:</label><br>
        <input type="text" id="phone" name="phone" value="{{ @old('phone') }}"><br><br>
        <label for="service">Select Services:</label><br>
        <select name="service" id="service">
            <option value="test 1">Test 1</option>
            <option value="test 2">Test 2</option>
            </select><br><br>
            <label for="location">Location:</label><br>
            <input type="text" id="location" name="location" value="{{ @old('location') }}"><br><br>

        
        {!! NoCaptcha::renderJs() !!}
        {!! NoCaptcha::display() !!}<br>
        <input type="submit" value="Submit">

    </form>


</body>

</html>
