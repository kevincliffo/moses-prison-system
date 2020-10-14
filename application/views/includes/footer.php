
                </div>
                <!-- End of Main Content -->
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Prison Registering System <?php echo date("Y"); ?></span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <?php 
                            $obj = array('class' => 'btn btn-primary');
                            echo anchor('main/logout', 'Logout', $obj);
                        ?>                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo base_url(); ?>vendor/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="<?php echo base_url(); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="<?php echo base_url(); ?>js/sb-admin-2.min.js"></script>
        <!-- Page level plugins -->
        <script src="<?php echo base_url(); ?>vendor/chart.js/Chart.min.js"></script>
        <!-- Page level custom scripts -->
        <script src="<?php echo base_url(); ?>js/demo/chart-area-demo.js"></script>
        <script src="<?php echo base_url(); ?>js/demo/chart-pie-demo.js"></script>
        
        <script type="text/javascript">
            function refreshTable(table, rows)
            {
                while(true)
                {
                    if(rows == 1)
                    {
                        break;
                    }
                    
                    for(var i = rows-1; i > 0; i--)
                    {
                        if(i == 0)
                        {

                        }
                        else
                        {
                            table.deleteRow(i);
                        }
                    }
                    break;
                }
            }
        </script>

        <script type="text/javascript">
            function generateReport()
            {
                var base_url = "<?php echo base_url(); ?>";
                var prison = document.getElementById("prison");
                var crime = document.getElementById("crime");
                var sentenceDate = document.getElementById("sentenceDate");
                var releaseDate = document.getElementById("releaseDate");
                var btngenerateReportData = document.getElementById("generateReportData");
                btngenerateReportData.disabled = true;
                
                var table = document.getElementById("dataTableReports");
                var rows = $("#dataTableReports tbody tr").length;

                refreshTable(table, rows);

                var table = document.getElementById("dataTableReports");
                var rows = $("#dataTableReports tbody tr").length;

                var prisonValue = prison.value;
                var crimeValue = crime.value;
                var sentenceDateValue = sentenceDate.value;
                var releaseDateValue = releaseDate.value;

                console.log(prisonValue);
                console.log(crimeValue);
                console.log(sentenceDateValue);
                console.log(releaseDateValue);
                
                $.ajax({
                    url: base_url + 'prisoners/getPrisonersOverFilter/',

                    type: 'post',
                    data:{
                            Prison : prisonValue,
                            Crime : crimeValue, 
                            SentenceDate: sentenceDateValue,
                            ReleaseDate: releaseDateValue
                        },
                    dataType: 'json',
                    success:function(response) {
                        var count = 1;
                        $.each(response, function(index, value) {
                            var row = table.insertRow(rows);
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            var cell3 = row.insertCell(2);
                            var cell4 = row.insertCell(3);
                            var cell5 = row.insertCell(4);
                            var cell6 = row.insertCell(5);
                            var cell7 = row.insertCell(6);
                            var cell8 = row.insertCell(7);
                            var cell9 = row.insertCell(8);
                            var cell10 = row.insertCell(9);

                            cell1.innerHTML = index+1;
                            cell2.innerHTML = value.FirstName;
                            cell3.innerHTML = value.LastName;
                            cell4.innerHTML = value.IDNumber;
                            cell5.innerHTML = value.Crime;
                            cell6.innerHTML = value.CrimeCounty;
                            cell7.innerHTML = value.Details;
                            cell8.innerHTML = value.Prison;
                            cell9.innerHTML = value.SentenceDate;
                            cell10.innerHTML = value.ReleaseDate;
                            
                            rows = $("#dataTableReports tbody tr").length;
                            count = count + 1;
                        });
                    }
                });
            }
        </script>
        <script type="text/javascript">
            function printReport(divName)
            {
                var printingArea = document.getElementById(divName).innerHTML;
                var allArea = document.body.innerHTML;
                var month = document.getElementById("month");
                var prisonType = document.getElementById("prisonType");

                var monthValue = "";
                var prisonTypeValue = "";


                if(month != null)
                {
                    monthValue = month.value;
                }
                if(prisonType != null)

                {
                    prisonTypeValue = prisonType.value;
                }

                document.body.innerHTML = printingArea;
                window.print();
                document.body.innerHTML = allArea;

                if(prisonType != null)
                {
                    var prisonType = document.getElementById("prisonType");

                    prisonType.value = prisonTypeValue;
                }

                if(month != null)
                {
                    var month = document.getElementById("month");
                    month.selectedIndex = monthValue;
                }
            }
        </script>
        <script type="text/javascript">
            function enableReportAccidentButton(){
                var b = document.getElementById("submit");
                var mvs = document.getElementById("motorvehicletypes");
                var cls = document.getElementById("colours");
                var nps = document.getElementById("numberplates");

                b.disabled = false;

                var counter = 1;
                var mv_id = "carType_";
                var cls_id = "colour_";
                var nps_id = "numberPlate_";
                var key = "";

                while(true){
                    try{
                        key = mv_id + counter.toString();
                        input = document.getElementById(key);
                        if(mvs.value == ""){
                            mvs.value = input.value ;
                        }
                        else{
                            mvs.value = mvs.value + "," + input.value;
                        }

                        key = cls_id + counter.toString();
                        input = document.getElementById(key);
                        if(cls.value == ""){
                            cls.value = input.value ;
                        }
                        else{
                            cls.value = cls.value + "," + input.value;
                        }

                        key = nps_id + counter.toString();
                        input = document.getElementById(key);
                        if(nps.value == ""){
                            nps.value = input.value ;
                        }
                        else{
                            nps.value = nps.value + "," + input.value;
                        }
                    }
                    catch(err){
                        console.log(err);
                        break;
                    }

                    counter = counter + 1;
                }                
            }
        </script>
        <script type="text/javascript">
            function hello(val) {
                var cb = document.getElementById(val);
            }
        </script>
        <script type="text/javascript">
            
            function add_new_row() {
                var table = document.getElementById("dataTableCars");
                var rows = $("#dataTableCars tbody tr").length;
                var row = table.insertRow(rows+1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);

                var row_id = 'carType_' + (rows + 1).toString();
                var colour_id = 'colour_' + (rows + 1).toString();
                var number_Plate_id = 'numberPlate_' + (rows + 1).toString();
                
                cell1.innerHTML = rows+1;
                cell2.innerHTML = '<select id="' + row_id + '" name="carType" class="form-control"  onChange="hello(`' + row_id + '`)">'
                                + '    <option selected disabled>Select Motor Vehicle Type</option>'
                                + '    <option value="Car">Car</option>'
                                + '    <option value="Tuktuk">Tuktuk</option>'
                                + '    <option value="Truck">Truck</option>'
                                + '    <option value="Bus">Bus</option>'
                                + '    <option value="Motor Bike">Motor Bike</option>'
                                + '</select>';
                cell3.innerHTML = '<input class="form-control" id="'+ colour_id + '" name="'+ colour_id + '" type ="text" placeholder = "Colour" required ="required"/>';
                cell4.innerHTML = '<input class="form-control" id="'+ number_Plate_id + '" name="'+ number_Plate_id + '" type ="text" placeholder = "Number Plate" required ="required"/>';
                // cell5.innerHTML = '<td style="text-align: center;"><button type="button" id="add_row" class="btn btn-default" onclick="add_new_row()"><i class="fa fa-plus"></i></button></td>';

            }
        </script>        
    </body>
</html>
