<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-50">Attached Documents</h4>
    </div>
    <div class="table-responsive">
        <table class="table text-nowrap text-center border-bottom">
            <thead>
            <tr>
                <th class="text-start">Title</th>
                <th>✉️ File</th>
                <th>🖥 Date Uploaded</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if($documents)
                @foreach($documents as $doc)
                    <tr>
                        <td class="text-start">{{$doc->title}}</td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                                <a href="{{$doc->CompanyDocument}}" target="_blank">View</a>
                            </div>
                        </td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                                <p>{{$doc->created_at->diffForHumans()}}</p>
                            </div>
                        </td>
                        <td wire:loading wire:target="removeDocument({{$doc->id}})" >
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </td>
                        <td wire:loading.remove wire:target="removeDocument({{$doc->id}})" >
                            <i class="fa fa-trash" wire:click="removeDocument({{$doc->id}})" style="cursor: pointer"></i>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

    <hr />
    <div class="table-responsive">
        <div class="modal-body">
            <form class="row" wire:submit.prevent="saveDocument">
                <div class="col-12">
                    <label class="form-label" for="basic-icon-default-fullname">Title*</label>
                    <input type="text" wire:model.lazy="title" class="form-control dt-full-name  {{$errors->has('title')? 'is-invalid' : '' }}"  placeholder="Document title"/>
                    @error('title') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-md-12 mt-1">
                    <div wire:loading wire:target="file" >
                        Validating document <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </div>
                    <label wire:loading.remove wire:target="banner" class="form-label" for="basic-icon-default-company">File* (PDF)</label>
                    <input type="file" wire:model="file"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('file')? 'is-invalid' : '' }}"/>
                    @error('file') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="card-body">
                    <button type="submit"  wire:loading.remove wire:target="saveDocument"  class="btn btn-primary me-1">Save document</button>
                    <button type="submit"  wire:loading wire:target="saveDocument"  class="btn btn-primary me-1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                </div>
            </form>
        </div>
    </div>

</div>
