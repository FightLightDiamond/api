<table class="table">
    <thead>
    <tr>
        <th>{{__('label.word')}}</th>
        <th>{{__('label.pronounce')}}</th>
        <th>{{__('label.meaning')}}</th>
        <th>{{__('label.type')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($vocabularies as $vocabulary)
        <tr>
            <td class="speakEnglish">{{$vocabulary->word}}</td>
            <td>{{$vocabulary->pronounce}}</td>
            <td>{{$vocabulary->meaning}}</td>
            <td>{{$vocabulary->type}}</td>

        </tr>
    @endforeach
    </tbody>
</table>

{!! $vocabularies->links() !!}