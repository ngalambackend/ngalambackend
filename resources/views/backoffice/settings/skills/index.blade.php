@extends('backoffice.layouts.app')
@section('title', 'Skill')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Skill</h1>
        <div class="section-header-button">
            <button class="btn btn-primary" id="add-skill">Add New</button>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('backoffice.home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Skill</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Skill</h2>
        <p class="section-lead">
            You can manage all skills, such as editing, deleting and more.
        </p>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Skills</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="skill-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="data-row"></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="modalPop" tabindex="-1" role="dialog" aria-labelledby="skill-form-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="skill-form-label">Add New</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="admin-body-content">
          <form id="skill-form" method="POST">
            @csrf
            <div class="form-group">
                <label for="name-input">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name-input">
                @error('name')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="$('#skill-form').submit()" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modalDel" tabindex="-1" role="dialog" aria-labelledby="skill-form-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="skill-form-label">Confirm Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="admin-body-content">
           Are you sure to delete this account?
           <form method="POST" id="delete-confirm">
               @csrf
               <input type="hidden" id="skill_id">
           </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" onclick="$('#delete-confirm').submit()" class="btn btn-danger">Yes, Deleted!</button>
        </div>
      </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
         /** Crete Form **/
         $(document).on('click', '#add-skill', function () {
            var options = {
                'backdrop': 'static'
            }

            $('#modalPop').modal(options)
            $('#skill-form-label').text('Add New')
            $('#skill-form').attr('action', "{{ route('backoffice.setting.skill.store') }}")
        })

         /** Edit Form **/
         $(document).on('click', '#edit-skill', function () {
            $(this).addClass('edit-skill-trigger-clicked') //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
            var options = {
                'backdrop': 'static'
            }

            $('#modalPop').modal(options)
            $('#skill-form-label').text('Edit Skill')
        })

        /** Delete Form **/
         $(document).on('click', '#delete-skill', function () {
            $(this).addClass('delete-skill-trigger-clicked') //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
            var options = {
                'backdrop': 'static'
            }

            $('#modalDel').modal(options)
            $('#skill-form-label').text('Confirm Delete')
        })

        /** Modal Show Up For Edit**/
        $('#modalPop').on('show.bs.modal', function () {
            var el    = $('.edit-skill-trigger-clicked')
            var row   = el.closest('.data-row')

            // Get the data
            var skill_id    = el.data('skill-id')
            var name        = row.children('.name').text()

            // Fill the field with data
            $('#name-input').val(name)
            $('#skill-form').attr('action', '/backoffice/setting/skill/update/' + skill_id)
        })

        /** Modal Show Up For Delete**/
        $('#modalDel').on('show.bs.modal', function () {
            var el    = $('.delete-skill-trigger-clicked')
            var row   = el.closest('.data-row')

            // Get the data
            var skill_id    = el.data('skill-id')

            $('#delete-confirm').attr('action', '/backoffice/setting/skill/destroy/' + skill_id)
        })

        /** Modal Hide For Edit**/
        $('#modalPop').on('hide.bs.modal', function () {
            $('.edit-skill-trigger-clicked').removeClass('edit-skill-trigger-clicked')
            $('#skill-form').trigger('reset')
        })

        /** Modal Hide For Delete**/
        $('#modalDel').on('hide.bs.modal', function () {
            $('.delete-skill-trigger-clicked').removeClass('delete-skill-trigger-clicked')
            $('#delete-confirm').trigger('reset')
        })


        $('#skill-table').DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('backoffice.setting.skill.indexJson') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'slug', name: 'slug'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [
                {  className: "name", targets: 1 },
                {  className: "slug", targets: 2 },
                {  className: "updated_at", targets: 3 },
            ],

            "createdRow": function( row, data, dataIndex ) {
                $(row).addClass( 'data-row' );
            }
        })
    })
</script>
@endsection
