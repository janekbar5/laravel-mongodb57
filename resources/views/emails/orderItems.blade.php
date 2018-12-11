@foreach ($orderItems as $item)
<tr>
    <td class="mcnImageContent" valign="top" style="padding-right: 0; padding-left: 0; padding-top: 0; padding-bottom: 20px; position: relative; display: block; width: 100px !important; height: 100px !important; text-align:center;">
        <img align="center" alt="" width="100" height="100" src="{{ $item['print'] }}" style="display: block; position: relative;left: 0; width: 100px !important; height: 100px !important; clip: rect(0px,100px,100px,0px); padding-bottom: 20px; vertical-align: bottom;" class="mcnImage">
    </td>
    <td>
        <p><b>{{ $item['cloth'] }}</b> ({{ $item['size'] }})</p>
    </td>
    <td>
        <p style="font-size: 12px; margin: 5px 0;">@if (!empty($item['thread']))Thread: {{ $item['thread'] }}@endif</p>
        <p style="font-size: 12px; margin: 5px 0;">@if (!empty($item['button']))Button: {{ $item['button'] }}@endif</p>
        <p style="font-size: 12px; margin: 5px 0;">@if (!empty($item['zip']))Zip: {{ $item['zip'] }}@endif</p>
    </td>
</tr>
@endforeach