<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<markers>
    @foreach ($markers as $marker)
        <marker name="{{$marker->name}}" address="{{$marker->address}}" lat="{{$marker->lat}}" lng="{{$marker->lng}}" type="{{$marker->type}}"/>
    @endforeach
</markers>