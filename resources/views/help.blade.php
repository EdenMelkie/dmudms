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

    <table style="margin: 20px 10px 20px;" class="table table-striped table-hover mb-0">
        <thead class="bg-primary text-white">
            <tr>
                <th class="py-2 px-2">Student ID</th>
                <th class="py-2 px-2">Full Name</th>
                <th class="py-2 px-2">username</th>
                <th class="py-2 px-2">password</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="align-middle">DMU1303808</td>
                <td class="align-middle">
                    Hailemariam Eyayu Beyene </td>
                <td class="align-middle">DMU1303808</td>
                <td class="align-middle">Beyene1234abcd#</td>
                <td rowspan="4" style="color: red;"> Note: use last name as it is. Don't try to capitalize or any other else...
                </td>

            </tr>
            <tr>
                <td class="align-middle">DMU1303809</td>
                <td class="align-middle">
                    Getnet Amare Worku </td>
                <td class="align-middle">DMU1303809</td>
                <td class="align-middle">Worku1234abcd#</td>
            </tr>
            <tr>
                <td class="align-middle">DMU1303810</td>
                <td class="align-middle">
                    Mekuanint Ayalew Getu </td>
                <td class="align-middle">DMU1303810</td>
                <td class="align-middle">Getu1234abcd#</td>
            </tr>
            <tr>
                <td class="align-middle">DMU1303811</td>
                <td class="align-middle">
                    Worku Manaye Yalew </td>
                <td class="align-middle">DMU1303811</td>
                <td class="align-middle">Yalew1234abcd#</td>
            </tr>

        </tbody>


    </table>
    <div style="margin-top: 20px;">
        As soon as you log in, you should change your temporary password before accessing any resource that needs your identity. Therefore, you have to fill the new password and other requested information properly. The new password should not be less than 8 characters.

        If you are unable to log in, please ask your concerned registrar office.... because your id number and/or grandfather name may not be encoded correctly....Remember what you fill in the biography form...

        If you have any difficulties, you can contact the concerned Registrar office.
    </div>
</div>
@endsection