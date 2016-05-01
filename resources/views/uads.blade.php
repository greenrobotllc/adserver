var A345 = " ";
@foreach ($add_code as $value)
@if (!empty(preg_replace('/\s+/', '', $value)))
 A345 += "<?=preg_replace('/\s+/', ' ', $value)?>\n";
@endif
@endforeach

document.write(A345);