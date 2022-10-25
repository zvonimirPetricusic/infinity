@extends('layouts.app')

@section('content')


<link rel="stylesheet" href="{{ asset('css/items.css') }}">
<link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">
<script type="application/javascript" src="{{ asset('js/items/items.js') }}"></script> 

<script type="application/javascript" src="{{ asset('js/similarity.min.js') }}"></script> 

<script type="application/javascript" src="{{ asset('js/chatbot.js') }}"></script> 

<body>
    @include('structure.adminStructure')
    <div id="subHeaderContainer">
        <div class="card-title">
            <h3><img src="../../img/settingBlack.png" class="icon" alt="Categories icon"> &nbsp; Items</h3>
        </div>
        <div class="card-toolbar" style="margin-left: 100px;">
            <a href="#addItem" data-toggle="modal" class="btn btn-outline-secondary btn-sm">
                {{ _('Add item') }}
            </a>
        </div>
    </div><br>
    <div id="bodyContainer">
        <div class="card-body" id="itemsContainer">   
          <?php foreach ($items as $item){?>
            <div class="card">
              <?php echo '<img src="/img/' . $item->filename . '" alt="Avatar" style="width:100%">'; ?> 
              <div class="container">
                <h4><b><?php echo $item->name; ?></b></h4> 
                <p><?php echo $item->description; ?></p> 
              </div>
            </div>
          <?php } ?>
        </div>
    </div> 

    @include('chatbot')

</body>

<div class="modal hide fad" id="addItem" role="dialog" aria-labelledby="addItem" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addItemForm" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Price:</label>
            <input type="text" class="form-control" id="name" name="price">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Color:</label>
            <input type="color" class="form-control" id="color" name="color">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Size:</label>
            <input type="text" class="form-control" id="size" name="size">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Quantity:</label>
            <input type="text" class="form-control" id="quantity" name="quantity">
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
            <label for="subcategory" class="col-form-label">Subcategory:</label>
            <select name="subcategories" id="subcategoriesSelect">

            </select>
          </div>
          <div class="form-group">
            <label for="description" class="col-form-label">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
          </div>
          <div class="form-group">
            <label for="file" class="col-form-label">Image:</label>
            <input type="file" class="form-control" id="file" name="file">
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveItem">Save</button>
      </div>
        </form>
      </div>

    </div>
  </div>
</div>


@endsection
