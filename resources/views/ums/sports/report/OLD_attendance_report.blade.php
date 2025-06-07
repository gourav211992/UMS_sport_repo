<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                margin: 0;
                padding: 0;
            }
    
            @page {
                size: A4 landscape;
                margin: 10mm;
            }
    
            .no-print {
                display: none !important;
            }
    
            #reportSection {
                transform: scale(0.75);
                transform-origin: top left;
                width: 100%;
                margin: 0 auto;
            }
    
            table {
                width: 100% !important;
                border-collapse: collapse;
                font-size: 10px !important;
                page-break-inside: avoid;
            }
    
            th, td {
                padding: 4px !important;
                word-break: break-word;
            }
        }
    </style>
</head>
<body>
    <!-- Include Bootstrap CSS (if not already included) -->



<div class="container  py-5" >

    <!-- Button Section -->
    <div class="d-flex justify-content-end gap-2 mb-3 no-print">
        <button type="button" onclick="window.history.back()" class="btn btn-secondary">
            Back
        </button>

        <button type="button" onclick="window.print()" class="btn btn-primary">
            Print Report
        </button>
    </div>

    <!-- Form Section -->
    <form id="form" class="center-form" method="post" action="/submit-report-comment">
        <div id="reportSection" class="border border-dark p-3" style="width: 1370px; font-family: Arial;">

            <!-- Header Table -->
            <table class="w-100 mb-3 text-dark text-center" style="font-size: 13px;">
                <tr>
                    <td class="fw-semibold fs-4">Sports Quest Centre of Excellence</td>
                </tr>
                <tr>
                    <td class="fs-6 py-2">Connecting Aspirations-Creating Champions</td>
                </tr>
                <tr>
                    <td class="fw-bold pt-3" style="line-height: 18px;">
                        Attendance Between <br />
                        (1st April to 30th April)
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold pt-3" style="line-height: 18px;">
                        Attendance Report
                    </td>
                </tr>
            </table>

            <!-- Info Table -->
            <table class="table table-bordered border-dark table-sm text-dark" style="font-size: 13px;">
                <tbody>
                    <tr>
                        <td class="fw-bold">1.</td>
                        <td class="fw-bold">Batch</td>
                        <td class="fw-bold">2021-2022</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">2.</td>
                        <td class="fw-bold">Section</td>
                        <td class="fw-bold">JR ADVANCE</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">3.</td>
                        <td class="fw-bold">Quota</td>
                        <td class="fw-bold">HL City Discount – 20% Court Fees</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">4.</td>
                        <td class="fw-bold">Start Date</td>
                        <td class="fw-bold">02-May-2020</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">5.</td>
                        <td class="fw-bold">End Date</td>
                        <td class="fw-bold">21-Jan-2021</td>
                    </tr>
                 </tbody>
            </table> 

        <!-- </div>
    </form>
</div> -->

<!-- hell -->
                

<div class="table-responsive">
    <table class="table w-100 fw-bolder mb-2 table-bordered " style="font-size: 13px; border: 1px solid #000;  " cellspacing="0" cellpadding="0">
        <tr class="table-secondary" style="border: 1px solid #000;">
            
                <th>Year</th>
                <th>2021</th>
                <th>Date</th>
                <!-- Loop for days 1–31 -->
                <!-- You can replace this loop with dynamic logic if using JS -->
                <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th>
                <th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th>
                <th>20</th><th>21</th><th>22</th><th>23</th><th>24</th><th>25</th><th>26</th><th>27</th><th>28</th>
                <th>29</th><th>30</th><th>31</th>
             
        </tr>
        <tr class="table-secondary" style="border: 1px solid #000;">
            
            <th>Year</th>
            <th>2021</th>
            <th>Date</th>
            <!-- Loop for days 1–31 -->
            <!-- You can replace this loop with dynamic logic if using JS -->
            <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th>
            <th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th>
            <th>20</th><th>21</th><th>22</th><th>23</th><th>24</th><th>25</th><th>26</th><th>27</th><th>28</th>
            <th>29</th><th>30</th><th>31</th>
         
    </tr>
    <tr class="table-secondary" style="border: 1px solid #000;">
            
        <th>Year</th>
        <th>2021</th>
        <th>Date</th>
        <!-- Loop for days 1–31 -->
        <!-- You can replace this loop with dynamic logic if using JS -->
        <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th>
        <th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th>
        <th>20</th><th>21</th><th>22</th><th>23</th><th>24</th><th>25</th><th>26</th><th>27</th><th>28</th>
        <th>29</th><th>30</th><th>31</th>
     
</tr>
       

        <tfoot class="  " style="border: 1px solid #000;">
            <tr>       <!-- First row empty cells -->
                <td>As21</td>
                <td>RekhaRaghav</td>
                <td>January</td>
                <!-- 31 empty day cells -->
                <td>P</td><td>L</td><td class="bg-light">
                    <span class="badge bg-secondary">H</span>
                  </td>
                <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
                    <span class="badge bg-secondary">H</span>
                  </td>
                <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
                    <span class="badge bg-secondary">H</span>
                  </td><td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
                    <span class="badge bg-secondary">H</span>
                  </td>
                <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
                    <span class="badge bg-secondary">H</span>
                  </td>
                
              
            </tr>
    <tr>       <!-- First row empty cells -->
        <td>As21</td>
        <td>RekhaRaghav</td>
        <td>January</td>
        <!-- 31 empty day cells -->
        <td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td><td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        
      
    </tr>
    <tr>       <!-- First row empty cells -->
        <td>As21</td>
        <td>RekhaRaghav</td>
        <td>January</td>
        <!-- 31 empty day cells -->
        <td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td><td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        
      
    </tr>
    <tr>       <!-- First row empty cells -->
        <td>As21</td>
        <td>RekhaRaghav</td>
        <td>January</td>
        <!-- 31 empty day cells -->
        <td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td><td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        
      
    </tr>
    <tr>       <!-- First row empty cells -->
        <td>As21</td>
        <td>RekhaRaghav</td>
        <td>January</td>
        <!-- 31 empty day cells -->
        <td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td><td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        
      
    </tr>
    <tr>       <!-- First row empty cells -->
        <td>As21</td>
        <td>RekhaRaghav</td>
        <td>January</td>
        <!-- 31 empty day cells -->
        <td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td><td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        
      
    </tr>
    <tr>       <!-- First row empty cells -->
        <td>As21</td>
        <td>RekhaRaghav</td>
        <td>January</td>
        <!-- 31 empty day cells -->
        <td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td><td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        
      
    </tr>
    <tr>       <!-- First row empty cells -->
        <td>As21</td>
        <td>RekhaRaghav</td>
        <td>January</td>
        <!-- 31 empty day cells -->
        <td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td><td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        <td>P</td><td>L</td><td>P</td><td>L</td><td>P</td><td>L</td><td class="bg-light">
            <span class="badge bg-secondary">H</span>
          </td>
        
      
    </tr>
        </tfoot>
    </table>
  </div>
  

               

            </div>
        </form>
     


</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</body>
</html>