                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Add Prisoner</h1>
                            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                        </div>

                        <div>
                            <?php 
                                echo form_open('prisoners/addprisonertodb');
                            ?>
                            <center><h3>User Details</h3></center>
                            <div class="form-group">
                                <div class="form-row">                                
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php
                                                $firstName = array('class' => 'form-control',
                                                            'id'=>'firstName',
                                                            'name'=>'firstName',
                                                            'type' => 'text',
                                                            'placeholder' => 'First Name',
                                                            'required' =>'required',
                                                            'autofocus'=>'autofocus'
                                                            );

                                                echo form_input($firstName);                     
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php 
                                                $lastName = array('class' => 'form-control',
                                                            'id'=>'lastName',
                                                            'name'=>'lastName',
                                                            'type' => 'text',
                                                            'placeholder' => 'Last Name',
                                                            'required' =>'required'
                                                            );

                                                echo form_input($lastName);                     
                                            ?>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="form-group">
                                <div class="form-row">                                
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php
                                                $idNumber = array('class' => 'form-control',
                                                            'id'=>'idNumber',
                                                            'name'=>'idNumber',
                                                            'type' => 'text',
                                                            'placeholder' => 'ID Number',
                                                            'required' =>'required'
                                                            );

                                                echo form_input($idNumber);                   
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <select id="prison" name="prison" class="form-control" required>
                                                <option selected disabled>Select Prison</option>
                                                <?php 
                                                    foreach($prisons as $prison)
                                                    {
                                                        echo '<option value='.$prison['Name']. '>'.$prison['Name'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="form-group">
                                <div class="form-row">                                
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php
                                                $crime = array('class' => 'form-control',
                                                            'id'=>'crime',
                                                            'name'=>'crime',
                                                            'type' => 'text',
                                                            'placeholder' => 'Crime',
                                                            'required' =>'required',
                                                            );
                                                echo form_input($crime);                      
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <select id="crimeCounty" name="crimeCounty" class="form-control" required>
                                                <option selected disabled>Select Crime County</option>
                                                <?php 
                                                    foreach($counties as $county)
                                                    {
                                                        echo '<option value='.$county['County']. '>'.$county['County'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="form-group">
                                <div class="form-row">                                
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php
                                                $sentenceDate = array('class' => 'form-control',
                                                    'id'=>'sentenceDate',
                                                    'name'=>'sentenceDate',
                                                    'type' => 'date',
                                                    'title' => 'Sentence Date',
                                                    'required' =>'required'
                                                );

                                                echo form_input($sentenceDate);                       
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php 
                                                $releaseDate = array('class' => 'form-control',
                                                    'id'=>'releaseDate',
                                                    'name'=>'releaseDate',
                                                    'type' => 'date',
                                                    'title' => 'Release Date',
                                                    'required' =>'required'
                                                );

                                                echo form_input($releaseDate);   
                                            ?>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="form-group">
                                <div class="form-row">                                
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php
                                                $details = array('class' => 'form-control',
                                                            'id'=>'details',
                                                            'name'=>'details',
                                                            'cols' => 3,
                                                            'rows' => 3,
                                                            'type' => 'text',
                                                            'title'=>'Details',
                                                            'required' =>'required'
                                                            );

                                                echo form_textarea($details);                       
                                            ?>
                                        </div>
                                    </div>
                                </div>                            
                            </div> 
                            <?php
                                $btn = array('class' => 'btn btn-primary btn-block',
                                            'value' => 'Add Prisoner',
                                            'name' => 'submit',
                                            'type' => 'submit');
                                echo form_submit($btn);        
                                echo form_close();
                            ?>
                        </div>
                    </div>
                    <!-- /.container-fluid -->                           