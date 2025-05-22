<!-- resources/views/about.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Help</h1>
        <p>This is the Help page content...</p>
        Dear Debre Markos University Students,


Login Guideline:

In order to see your detail result, first you must login. The login link is located at the Right Section /above the Online Users Section/.

When the log in screen is displayed, you must enter your user name and password. Refer the following example table on how to use your id number and your Grandfather name as your user name and initial password respectively.

<img src="{{ asset('images/login_guideline.png') }}" alt="Login guideline" class="mt-4 rounded shadow-lg max-w-full h-auto">
 
As soon as you log in, you should change your temporary password before accessing any resource that needs your identity. Therefore, you have to fill the new password and other requested information properly. The new password should not be less than 8 characters.

 If you are unable to log in, please ask your concerned registrar office.... because your id number and/or grandfather name may not be encoded correctly....Remember what you fill in the biography form...

If you have any difficulties, you can contact the concerned Registrar office.
    </div>
@endsection
