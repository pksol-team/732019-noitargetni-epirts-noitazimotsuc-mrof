<?php
$writerCategory = Auth::user()->writerCategory;
$cpp = $writerCategory->cpp;
$decrease_percent = $writerCategory->deadline;
$category_id = $writerCategory->id;
        $bidmapper = $order->bidMapper;
if($order->status=='1'){
   $assign = $order->assigns()->where([
        ['user_id','like',Auth::user()->id],
        ['status','<',4]
    ])->first();
    $b_deadline = \Carbon\Carbon::createFromTimestamp(strtotime($assign->deadline));
}else{
$b_deadline = \Carbon\Carbon::createFromTimestamp(strtotime($bidmapper->deadline));

$c_deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));
if($bidmapper->deadline == '0000-00-00 00:00:00'){
    $decrease_percent = 100-$decrease_percent;
    $decrease_percent = $decrease_percent/100;
    $new_hours = $c_deadline->diffInHours()*$decrease_percent;
    $b_deadline = \Carbon\Carbon::now()->addHours($new_hours);
}
$now = date('y-m-d H:i:s');
        }
$deadline = $b_deadline->toDateTimeString();

?>
<div id="o_order" class="tab-pane fade in active">
    <table align="centre" class="table table-bordered">
        <tr>
                <td colspan="4"><p style="font-size: large; font-weight: bold;">#{{ $order->id}}-{{ $order->topic }}</p></td>
        </tr>
        <tr>

        </tr>
        <tr>
            <td class="titlecolumn">Type of Paper</td>
            <td>{{ $order->document->label }}</td>
            <td class="titlecolumn">English Style</td>
            <td>{{ $order->language->label }}</td>

        </tr>
        <tr>
            <td class="titlecolumn">Subject Area</td>
            <td>{{ $order->subject->label }}</td>
            <th class="titlecolumn">Writer Category</th>
            <td>{{ @$order->writerCategory->name }}</td>
        </tr>
        <tr>
            <td class="titlecolumn">Academic Level</td>
            <td>{{ ucwords($order->academic->level) }}</td>
            <td class="titlecolumn">Sources</td>
            <td>{{ $order->sources }}</td>


        </tr>
        <tr>
            <td class="titlecolumn">Number of Pages</td>
            <?php $multiply = $order->spacing==2 ? 1:2  ?>
            <td>{{ $order->pages.' page(s) / '.$multiply*275*$order->pages.' Words' }}</td>
            <td class="titlecolumn">Referencing Style</td>
            <td>{{ $order->style->label }}</td>
        </tr>
        <tr>
            <td class="titlecolumn">Spacing</td>
            <td><?php
                if($order->spacing==1){
                    echo "Single Spaced";
                }else{
                    echo "Double Spaced";
                }?></td>
            <td class="titlecolumn">Deadline</td>
            <td>{!! $deadline !!}</td>
        </tr>
        <tr>
            <td colspan="4"><strong>Order Instructions</strong></td>
        </tr>
        <tr>
            <td colspan="4">{!! nl2br($order->instructions) !!}</td>
        </tr>

    </table>
</div>
<style type="text/css">
    .titlecolumn {
        background: whitesmoke;
        white-space: nowrap;
        text-align: right;
        font-weight: bold;
        width: 5%;
    }
</style>

