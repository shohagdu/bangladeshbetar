<div class="col-sm-12" style="margin-top:10px;margin-bottom:80px;">
    <p style="font-size:20px;">কেন্দ্রঃ {{$station->name}} </p>
    <p style="font-size:20px;">সাব-কেন্দ্রঃ {{ $sub_station->title }} ({{ $sub_station->fequencey }}) </p>
    <p style="font-size:20px;">বারঃ {{$day->title_bn}}</p>
    @foreach($schedule as $parentKey => $info)

        <table class="table-bordered table">

            <thead>

                <tr>
                    <th colspan="4">
                        {{ get_odivision($parentKey)->title.' ('.get_odivision($parentKey)->schedule_time.')' }}
                    </th>
                </tr>

                <tr>
                    <td>সময়</td>
                    <td>অনুষ্ঠানের টাইটেল</td>
                    <td>মন্তব্য</td>
                    <td>রেকর্ড/সজিব</td>
                </tr>
            </thead>

            <tbody>
                @foreach($info as $chieldKey => $value)
                    <tr>
                        <td>{{$value->time}}</td>
                        <td>
                            {{$value->title}}
                        </td>
                        <td>{{$value->comment}}</td>
                        <td><span class='{{ $value->is_recorded==true? "glyphicon glyphicon-ban-circle": "glyphicon glyphicon-remove" }}'></span></td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="4">
                    </td>
                </tr>
            </tfoot>

        </table>
        

    @endforeach

</div>
<div class="clearfix"></div>