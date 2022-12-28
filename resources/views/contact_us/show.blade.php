<!DOCTYPE html>
<html>

<body>

    <h2>Contact-Us</h2>

    <form action="{{ route('contact-us.store') }}" method="post" role="form" class="php-email-form" data-aos="fade-up"
        data-aos-delay="100">
        @csrf
        <label for="fname">First name:</label><br>
        <input type="text" id="name" name="name" value="{{ @old('name') }}"><br><br>
        <label for="lname">Email:</label><br>
        <input type="text" id="email" name="email" value="{{ @old('email') }}"><br><br>
        <label for="lname">Phone Number:</label><br>
        <input type="text" id="phone" name="phone" value="{{ @old('phone') }}"><br><br>
        <p><label for="w3review">Message</label></p>
        <textarea id="message" name="message" rows="4" cols="50"></textarea><br><br>
        {!! NoCaptcha::renderJs() !!}
        {!! NoCaptcha::display() !!}<br>
        <input type="submit" value="Submit">

    </form>


</body>

</html>
