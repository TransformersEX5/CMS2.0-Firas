<style>
    .avatar-wrapper {
        position: relative;
        height: 200px;
        width: 200px;
        margin: 50px auto;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 1px 1px 15px -5px black;
        transition: all .3s ease;

        &:hover {
            transform: scale(1.05);
            cursor: pointer;
        }

        &:hover .profile-pic {
            opacity: .5;
        }

        .profile-pic {
            height: 100%;
            width: 100%;
            transition: all .3s ease;

            &:after {
                font-family: FontAwesome;
                content: "\f007";
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                position: absolute;
                font-size: 190px;
                background: #ecf0f1;
                color: #34495e;
                text-align: center;
            }
        }

        .upload-button {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;

            .fa-arrow-circle-up {
                position: absolute;
                font-size: 234px;
                top: -17px;
                left: 0;
                text-align: center;
                opacity: 0;
                transition: all .3s ease;
                color: #34495e;
            }

            &:hover .fa-arrow-circle-up {
                opacity: .9;
            }
        }
    }
</style>



<div class="avatar-wrapper">
    <img class="profile-pic" src="" />
    <div class="upload-button">
        <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
    </div>
    <input class="file-upload" type="file" accept="image/*" />
</div>


<?php


$script = <<<JS
$(document).ready(function() {
	
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});

JS;
$this->registerJs($script);
?>