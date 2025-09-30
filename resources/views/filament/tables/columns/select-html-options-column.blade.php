<div {{ $getExtraAttributeBag() }}>
    {{ basename(get_class($getRecord())).':'.json_encode($getRecord()->id) }}<br/>
    {{ basename(get_class($record)).':'.json_encode($record->id) }}
</div>
