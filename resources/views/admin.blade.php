<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Email Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        .form-panel {
            background-color: #fff; /* White background for form panels */
            border: 1px solid #ddd; /* Gray border */
            border-radius: 5px; /* Rounded corners */
            padding: 20px; /* Padding */
            margin-bottom: 20px; /* Bottom margin */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row" style="margin-top: 40px;">
        <div class="col-lg-12">
            <!-- Alerts -->
            @if(session()->has('success'))
                <div style="margin-top: 0px;" class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0 mt-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-lg-6">
            <div class="form-panel">
                <h2 style="margin-top: 0px; margin-bottom: 30px;">Change Email</h2>
                <!-- Form -->
                <form action="{{ route('update') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" id="email" placeholder="Enter email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password to change email" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-panel">
                <h2 style="margin-top: 0px; margin-bottom: 30px;">Change Password</h2>
                <!-- Form -->
                <form action="{{ route('update-password') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="old_password">Old Password:</label>
                        <input type="password" class="form-control" id="old_password" placeholder="Enter old password" name="old_password">
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password:</label>
                        <input type="password" class="form-control" id="new_password" placeholder="Enter new password" name="new_password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirm_password" placeholder="Enter confirm password" name="confirm_password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
