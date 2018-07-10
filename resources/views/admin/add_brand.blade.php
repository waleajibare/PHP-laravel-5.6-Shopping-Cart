@extends('admin_layout')

@section('admin_content')
   

			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Add Brand</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Brand</h2>
						
					</div>

					<p class="alert-success">
						<?php

                        $message = Session::get('message');

                        

                        if ($message)

                        {
                        	echo $message;
                        	Session::put('message', null);
                        }

                        ?>

                       
					</p>
					<div class="box-content">
						<form class="form-horizontal" action="{{ url('/save-brand')}}" method="post">
							{{ csrf_field() }}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="manufacture_name">Brand Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="manufacture_name" required>
							  </div>
							</div>      
							<div class="control-group hidden-phone">
							  <label class="control-label" for="manufacture_description">Brand Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="manufacture_description" rows="3" required></textarea>
							  </div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Publication Status</label>
							  <div class="controls">
								<input  name="publication_status" type="checkbox" value="1">
							  </div>
							</div>

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Brand</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

@endsection