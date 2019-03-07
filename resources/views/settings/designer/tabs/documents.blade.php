<br/><a href="#document_modal" onclick="resetForm('document_form')" data-toggle="modal" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Document</a>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    @foreach($documents as $document)    
        <tr>
            <td>{{ $document->id }}</td>
            <td>{{ $document->label }}</td>
            <td>
                <button class="btn btn-xs btn-success" onclick="getEditItem('{{ URL::to('designer/document') }}',{{ $document->id }},'document_modal')"><i class="fa fa-pencil"></i> Edit</button>
                <button class="btn btn-xs btn-danger" onclick="deleteItem('{{ URL::to("designer/document") }}',{{ $document->id }})"><i class="fa fa-trash"></i> Delete</button>
            </td>
        </tr>
    @endforeach
</table>
<div class="modal fade" id="document_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <a data-dismiss="modal" class="btn btn-danger pull-right">&times;</a>
                    Document Form
                </div>
            </div>
            <div class="modal-body">
                <form id="document_form" class="form-horizontal ajax-post" action="{{ URL::to('designer/document') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Subject</label>
                        <div class="col-md-8">
                            <select name="subject_id" class="form-control">
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="label">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">&nbsp;</label>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>