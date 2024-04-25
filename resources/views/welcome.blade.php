<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
        document.getElementById("contactForm").submit();
    }
</script>
<style>
    body{
        background-color: #25274d;
    }
    .contact{
        padding: 4%;
        height: 500px;
    }
    .row{
        padding-bottom: 50px;
    }
    .col-md-3{
        background: #2739c7;
        padding: 4%;
        border-top-left-radius: 0.5rem;
        border-bottom-left-radius: 0.5rem;
    }
    .contact-info{
        /*margin-top:10%;*/
    }
    .contact-info img{
        margin-bottom: 15%;
    }
    .contact-info h2{
        margin-bottom: 10%;
    }
    .col-md-9{
        background: #fff;
        padding: 3%;
        border-top-right-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
    }
    .contact-form label{
        font-weight:600;
    }
    .contact-form button{
        background: #25274d;
        color: #fff;
        font-weight: 600;
        width: 25%;
    }
    .contact-form button:focus{
        box-shadow:none;
    }
</style>
<!------ Include the above in your HEAD tag ---------->

<div class="container contact">
    <div class="row">
        <div class="col-md-3">
            <div class="contact-info">
                <img src="{{ asset('images/ashraf.png') }}" style="width: 175px;" alt="image"/>
            </div>
        </div>
        <div class="col-md-9">
            <div class="contact-form">
                <div class="pl-3 mb-3">
                    <h1><b>Contact Ashraf Khan</b></h1>
                    <span><i>The email you have reached is not being monitored; please leave a message and I will  get back to you ASAP.</i></span>
                </div>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
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
                <form id="contactForm" class="contact1-form validate-form" method="post" action="{{ route('send-email') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name: <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email: <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="phone">Phone:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="attachments">Attachments:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="message">Message: <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" cols="100" name="message" id="message"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <div class="g-recaptcha mt-4" data-sitekey={{config('services.recaptcha_v3.key')}}></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button class="g-recaptcha btn btn-primary btn-lg "
                                    data-sitekey="{{ config('services.recaptcha_v3.Key') }}"
                                    data-callback="onSubmit"
                                    data-action="submitContact">Submit</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
