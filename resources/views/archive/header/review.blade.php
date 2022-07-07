<div class="col-sm-12" style="margin-top:10px;">
    <form class="form-inline" method="get"  action="">
        <div class="form-group">
            <select  placeholder="বাছাই করুন" class="select2" name="created_by" style="width:120%; !important">
                <option value="">ইউজার বাছাই করুন</option>
                @foreach($employee_info as $item)
                    <option {{ app('request')->input('created_by') ? ( app('request')->input('created_by') == $item->id ? 'selected':'' ) :'' }} value="{{$item->id}}">{{$item->emp_name}}</option>
                @endforeach;
            </select>
        </div>
        <div class="form-group">
            <label for="email">স্ট্যটাস:</label>
            <select class="form-control" name="status">
                <option  value="">বাছাই করুন</option>
                <option {{ app('request')->input('status')=='0'?'selected':'' }} value="0">রিভিউ হয়নি</option>
                <option {{ app('request')->input('status') ? (app('request')->input('status')==2?'selected':'') :'' }} value="2">সংশোধন প্রয়োজন</option>
                <option {{ app('request')->input('status') ? (app('request')->input('status')==1?'selected':'') :'' }} value="1">আর্কাইভ হয়েছে</option>
            </select>
        </div>
        <div class="form-group">

            <label for="email">শুরুর তারিখ:</label>
            <input type="text" class="form-control datepickerLong" value="{{ app('request')->input('from_date') ? app('request')->input('from_date') :'' }}" autocomplete="off" placeholder="এন্ট্রি শুরুর তারিখ" name="from_date">
        </div>
        <div class="form-group">
            <label for="pwd">শেষের তারিখ:</label>
            <input type="text" class="form-control datepickerLong" value="{{ app('request')->input('to_date') ? app('request')->input('to_date') :'' }}" autocomplete="off" placeholder="এন্ট্রি শেষের তারিখ" name="to_date">
        </div>
        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
    </form>

    <br/>
    <input type="hidden" id="playlist_id" name="playlist_id" value="<?php echo isset($active_playlist->playlist_id)?$active_playlist->playlist_id:'' ?>"/>
    <input type="hidden" id="playlist_name" value="<?php  echo isset($active_playlist->name)?$active_playlist->name:'' ?>"/>
    <audio style="margin-left:300px;" controls id="player">
        <source id="audioSource" src="" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
</div>