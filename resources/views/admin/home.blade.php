@extends('layout.admin')
@section('title', 'Home')

@section('content')

<form method="post" action="http://www.bdlawcentre.com/saveinfo" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="niWWBD7ldiBy58mxh39oXW4wQhqd3ZRsg4xbHGkn">
    <div class="row">
        <div class="col-lg-5">
            <div class="form-group">
                <label for="title">Title</label><br>
                <input type="text" class="form-control" name="title" placeholder="Enter Title" required autofocus value="BD Law Centre">
            </div>
            <div class="form-group">
                <label for="moto">Moto</label><br>
                <input type="text" class="form-control" name="moto" placeholder="Enter Moto" required autofocus value="Fast-serving law firm">
            </div>
            <div class="form-group">
                <label for="scroll_text">Scroll Text</label><br>
                <input type="text" class="form-control" name="scroll_text" placeholder="Enter Scroll Text" required autofocus value="Welcome to BD Law Centre. The fast-serving law firm of Bangladesh">
            </div>
            <div class="form-group">
                <label for="address">Address</label><br>
                <input type="text" class="form-control" name="address" placeholder="Enter Address" required autofocus value="Dhaka, Bangladesh">
            </div>
            <div class="form-group">
                <label for="email">Email</label><br>
                <input type="text" class="form-control" name="email" placeholder="Enter Email" required autofocus value="contact@bdlawcentre.com">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label><br>
                <input type="text" class="form-control" name="phone" placeholder="Enter Contact Number" required autofocus value="+(88) 01711-993639">
            </div>
            <div class="form-group">
                <label for="facebook">Facebook</label><br>
                <input type="text" class="form-control" name="facebook" placeholder="Enter Facebook ID Link" required autofocus value="https://www.facebook.com/BangladeshLawCentre">
            </div>
            <div class="form-group">
                <label for="messenger">Messenger</label><br>
                <input type="text" class="form-control" name="messenger" placeholder="Enter Messenger Link" required autofocus value="https://www.facebook.com/BdLawCentre">
            </div>
            <div class="form-group">
                <label for="whatsapp">Whatsapp</label><br>
                <input type="text" class="form-control" name="whatsapp" placeholder="Enter Whatsapp Number" required autofocus value="+(88) 01711-993639">
            </div>
            <div class="form-group">
                <label for="skype">Skype</label><br>
                <input type="text" class="form-control" name="skype" placeholder="Enter Skype ID" required autofocus value="bdlawcentre">
            </div>
        </div>
        <div class="col-lg-5">
            <div class="form-group">
                <label for="viber">Viber</label><br>
                <input type="text" class="form-control" name="viber" placeholder="Enter Viber Number" required autofocus value="+(88) 01711-993639">
            </div>
            <div class="form-group">
                <label for="imo">Imo</label><br>
                <input type="text" class="form-control" name="imo" placeholder="Enter Imo Number" required autofocus value="+(88) 01711-993639">
            </div>
            <div class="form-group">
                <label for="youtube">Youtube</label><br>
                <input type="text" class="form-control" name="youtube" placeholder="Enter Youtube Link" required autofocus value="https://www.youtube.com/channel/UCl4ERPyULDEaGk5OfOBsWrQ">
            </div>
            <div class="form-group">
                <label for="twitter">Twitter</label><br>
                <input type="text" class="form-control" name="twitter" placeholder="Enter Twitter Link" required autofocus value="https://twitter.com/bd_lawcentre">
            </div>
            <div class="form-group">
                <label for="linkedin">Linked IN</label><br>
                <input type="text" class="form-control" name="linkedin" placeholder="Enter Linked In ID" required autofocus value="https://www.linkedin.com/home?trk=nav_responsive_tab_home">
            </div>
            <div class="form-group">
                <label for="gplus">Google Plus</label><br>
                <input type="text" class="form-control" name="gplus" placeholder="Enter Google Plus ID" required autofocus value="https://plus.google.com/u/2/113093318782749641503?_ga=1.182708902.1809133291.1450810665">
            </div>
            <div class="form-group">
                <label for="instagram">Instagram</label><br>
                <input type="text" class="form-control" name="instagram" placeholder="Enter Instagram ID" required autofocus value="http://instagram.com">
            </div>
            <div class="form-group">
                <label for="pinterest">Pinterest</label><br>
                <input type="text" class="form-control" name="pinterest" placeholder="Enter Pinterest ID" required autofocus value="http://pinterest.com">
            </div>
            <div class="form-group">
                <label for="logo">Logo</label><br>
                <input type="file" name="logo">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary ">Save</button>
</form>
@endsection
