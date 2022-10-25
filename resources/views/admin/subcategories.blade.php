@extends('layouts.app')

@section('content')



<script type="application/javascript" src="{{ asset('js/categories/subcategories.js') }}"></script> 

<body>
    @include('structure.adminStructure')
    <div id="subHeaderContainer">
        <div class="card-title">
            <h3><img src="../../img/settingBlack.png" class="icon" alt="Categories icon"> &nbsp; Subcategories</h3>
        </div>
        <div class="card-toolbar" style="margin-left: 100px;">
            <a href="#addSubcategory" data-toggle="modal" class="btn btn-outline-secondary btn-sm">
                {{ _('Add subcategory') }}
            </a>
        </div>
    </div><br>
    <div id="bodyContainer">
        <div class="card-body">
            <table class="table table-striped table-bordered" id="subcategories">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                </tr>
                </thead>
            </table>
        </div>
    </div> 



</body>

<div class="modal fade" id="addSubcategory" tabindex="-1" role="dialog" aria-labelledby="addSubcategory" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New subcategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addSubcategoryForm" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="category" class="col-form-label">Category:</label>
            <select name="categories" id="categoriesSelect">
                <?php foreach ($categories as $category){?>
                <option value='<?php echo $category["id"];?>'><?php echo $category["name"];?></option>
                <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="description" class="col-form-label">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveSubcategory">Save</button>
      </div>
        </form>
      </div>

    </div>
  </div>
</div>

@endsection
