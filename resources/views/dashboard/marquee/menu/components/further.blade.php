<table class="table table-bordered table-hover" id="further_detail">
    <thead>
    <tr>
        <th class="text-center">Base Material </th>
        <th class="text-center">Solution</th>
        <th class="text-center">Patawa</th>
        <th class="text-center">Thread</th>
        <th class="text-center">Ornament</th>
        <th class="text-center">Cost </th>
    </tr>
    </thead>
    <tbody id="test-body">
    <tr id="row">
        <td>
            {!!  Form::text('base_material',null,['id'=>'base_material','class'=>'form-control ','placeholder'=>'Start Writing','required']) !!}
        </td>
        <td>
            {!!  Form::text('solution',null,['id'=>'solution','class'=>'form-control ','placeholder'=>'Start Writing']) !!}
        </td>
        <td>
            {!!  Form::text('patawa',null,['id'=>'patawa','class'=>'form-control ','placeholder'=>'Start Writing']) !!}
        </td>
        <td>
            {!!  Form::text('thread',null,['id'=>'thread','class'=>'form-control ','placeholder'=>'Start Writing']) !!}
        </td>
        <td>
            {!!  Form::text('ornament',null,['id'=>'ornament','class'=>'form-control ','placeholder'=>'Start Writing']) !!}
        </td>
        <td>
            {!!  Form::text('other',null,['id'=>'other','class'=>'form-control ','placeholder'=>'Start Writing']) !!}
        </td>
    </tr>
    </tbody>
</table>
