@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stop

@section('content')

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                  <h2 style="text-align: center"><i class="fa fa-fw fa-gears"></i> Properties</h4>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ID</label>
                        <input disabled type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Label</label>
                        <input disabled type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                      </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sub Class Of</label>
                    <input disabled type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="">Constraint</label>
                    <textarea class="form-control"></textarea>
                  </div>
                  <div class="form-group" data-select2-id="13">
                    <label>Disjoint With</label>
                    <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                      <option data-select2-id="17">Alabama</option>
                      <option data-select2-id="18">Alaska</option>
                      <option data-select2-id="19">California</option>
                      <option data-select2-id="20">Delaware</option>
                      <option data-select2-id="21">Tennessee</option>
                      <option data-select2-id="22">Texas</option>
                      <option data-select2-id="23">Washington</option>
                    </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="8" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="Select a State" style="width: 541.5px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                  </div>
                  <div class="form-group" data-select2-id="13">
                    <label>Equivalent To</label>
                    <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                      <option data-select2-id="17">Alabama</option>
                      <option data-select2-id="18">Alaska</option>
                      <option data-select2-id="19">California</option>
                      <option data-select2-id="20">Delaware</option>
                      <option data-select2-id="21">Tennessee</option>
                      <option data-select2-id="22">Texas</option>
                      <option data-select2-id="23">Washington</option>
                    </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="8" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="Select a State" style="width: 541.5px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                  </div>
                  <div class="form-group" data-select2-id="13">
                    <label>Has Synonym</label>
                    <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                      <option data-select2-id="17">Alabama</option>
                      <option data-select2-id="18">Alaska</option>
                      <option data-select2-id="19">California</option>
                      <option data-select2-id="20">Delaware</option>
                      <option data-select2-id="21">Tennessee</option>
                      <option data-select2-id="22">Texas</option>
                      <option data-select2-id="23">Washington</option>
                    </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="8" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="Select a State" style="width: 541.5px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                  </div>
                  <div class="form-group">
                    <label for="">Sublcass of Anonymous Ancestor</label>
                    <textarea class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Disjoint Union Of</label>
                    <textarea class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <div class="input-group margin">
                        <input type="text" class="form-control">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-info btn-flat">ADD</button>
                            </span>
                      </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <h2 style="text-align: center"><i class="fa fa-fw fa-comment"></i> Annotations</h4>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Definition</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Definition Source</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Alternative Term</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Editor Note</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Curator Note</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">See Also</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Is Defined By</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Comment</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Version Info</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Previor Version</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Member</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">License</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Contributor</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Elucidation</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Term Editor</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@stop

@section('footer')
    .
@stop
