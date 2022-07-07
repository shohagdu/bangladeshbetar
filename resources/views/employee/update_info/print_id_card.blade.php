<style>
    @media print { html, body { height: 99%; } }
    /*html, body {*/
        /*height: 99%;*/
        /*font-family:"Impact" !important*/
    /*}*/
    @page {
        width: 635px;
        height: 1000px;
    }
    div#barcode_wrapper span div svg g g text tspan{
        font-size: 0px;

    }
    img#id_skeleton{
        /*border: 1px solid red;*/
        position: absolute;
        top: 0;
    }

    div.id_card_wrapper{
        margin: 15px;
        float: left;
        height: 1000px;
        width: 635px;

    }
    div#id_info{
        /*border: 1px solid red;*/
        height: 840px;
        position: absolute;
        top: 24px;
        left: 17px;
        width: 635px;
        z-index: 999;
    }
    div#id_info_inner_wrapper{
        /*border: 1px solid green;*/
        height: 495px;
        margin-top: 329px;
        width: 600px;
    }
    /*    #emp_img_wrapper img#emp_img{
            border: 2px solid white;
            position: absolute;
            height: 295px;
            left: 185px;
            top: 341px;
            width: 245px;
        }*/

    #emp_img_wrapper{
        /*border: 1px solid black;*/
        position: relative;
        height: 295px;
        left: 135px;
        top: 12px;
        width: 315px;
        background-color: #9D0A0E;
    }
    /*    img.center_fixed{
            max-height: 100%;
            max-width: 100%;
            width: auto;
            height: auto;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }*/


    #card_type_wrapper{
        position: absolute;
        /*border: 1px solid green;*/
        font-family: "Impact";
        color: #9D0A0E !important;
        letter-spacing: 3px;
        top: 255px;
        left: 35px;
        width: 565px;
        height: 50px;
        font-size: 40px;
        font-size-adjust: 1.0;
        z-index: 101;
        text-align: center;
        text-transform: uppercase;
    }
    #department_wrapper{
        position: absolute;
        text-transform: uppercase;
        font-family: "Impact";
        color: #FFF !important;
        left: -75px;
        top: 413px;
        width: 318px;
        height: 150px;
        text-align: center;
        transform: rotate(270deg);
        word-wrap: break-word;
        line-height: 48px;
    }
    #department_wrapper span#dept{
        transform: rotate(270deg);
        font-size: 42px;
        font-weight: bold;
        font-size-adjust: 0.8;
        color: white !important;
        vertical-align: middle;
        transform-origin: 10% 40%;
        margin: auto;
        letter-spacing: 2px;
    }
    #barcode_wrapper{
        /*border: 1px solid green;*/
        position: absolute;
        right: -56px;
        top: 452px;
        transform: rotate(270deg);
    }
    #barcode_id_wrapper{
        /*border: 1px solid green;*/
        position: absolute;
        right: -16px;
        font-size: 36px;
        top: 452px;
        transform: rotate(270deg);
    }
    p#name_Desig_wrapper{
        font-size: 40px;
        top: 658px;
        height: 110px;
        text-align: center;
        width: 598px;
        position: absolute;
        z-index: 999;
        letter-spacing: 4px;

    }
    p#name_Desig_wrapper span#desig_span{
        font-size: 28px;
    }
    p#sign_img_wrapper{
        position: absolute;
        /*border: 1px solid green;*/
        top: 825px;
        left: 221px;
        width: 268px;
    }
    p#sign_img_wrapper img{
        width: 80%;
    }
</style>
<div class="row">
    <div class="id_card_wrapper">
        <img id="id_skeleton" src="{{ url('fontView\assets\content\id_card\template.jpg')  }}" alt="ID Skeleton" />
        <div id="id_info">
            <div id="id_info_inner_wrapper">
                <div id="card_type_wrapper">
                    {{ $employee_info->station_name}}
                </div>
                <div id="department_wrapper">
                    <span id="dept" style="color: #FFF">
                        {{ $employee_info->department_title}}
                    </span>
                </div>
                <div id="emp_img_wrapper">
                    <img id="emp_img" src="{{ ((file_exists('images/employee_image/'.$employee_info->image) && !empty($employee_info->image) )?url('images/employee_image/'.$employee_info->image):url('fontView\assets\content\id_card\no-image-id-male.jpg'))  }}"  style="width:100%;height: 100%;" />
                </div>
                <div id="barcode_wrapper" class="barcode">
                    <?php
                          echo $bar_code_employee_id;
                    ?>
                </div>
                <div id="barcode_id_wrapper">
                    <span>{{ $employee_info->employee_id}}</span>
                </div>
                <p id="name_Desig_wrapper">

                    <span id="name_span" style="text-transform: uppercase;">{{ $employee_info->emp_name}}</span><br>
                    <span id="desig_span" style="text-transform: uppercase;"> {{ $employee_info->designation_title}}</span>
                </p>
                <p id="sign_img_wrapper">
                    <img id="sign_img" src="{{ url('fontView\assets\content\signature\signature.png') }}" style="height: 40px;width:200px;">
                </p>
            </div>
        </div>
    </div>
</div>


