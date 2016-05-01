<?php 
    $profit_adsense = $adsense_earn_yesterday - $adsense_income_without_rotation;
    $profit_lsm = $lsm_earn_yesterday - $lsm_income_without_rotation; 
    $total_expected = ($lsm_earn_yesterday + $adsense_earn_yesterday) - $total_without_rotation 
?>
<div class="row " data-name="yesterday">
               <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-maroon">
                <div class="inner">
                  <h3><sup style="font-size: 20px">$</sup>{{$lsm_earn_yesterday + $adsense_earn_yesterday}} <sup style="font-size: 20px">(${{$total_expected}}
                  @if ($total_expected == 0)
                   <span class="fa fa-ellipsis-h" style="color:yellow" title="Income will remain same on random rotation and rpm based rotation"></span>
                   @elseif($total_expected > 0)
                   <span class="fa fa-sort-asc" style="color:green" title="Income increased by our system"></span>
                   @else
                   <span class="fa fa-sort-desc" style="color:red" title="Income decreased"></span>
                   @endif
                   )</sup></h3>
                  <p>Total Earning Yesterday</p>
                </div>
                
                <div class="icon">
                  <i class="fa fa-money"></i>
                </div>
               
              </div>
            </div><!-- ./col -->         
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><sup style="font-size: 20px">$</sup>{{$lsm_earn_yesterday}} <sup style="font-size: 20px">(${{$profit_lsm}}
                  @if ($profit_lsm == 0)
                   <span class="fa fa-ellipsis-h" style="color:yellow"></span>
                   @elseif($profit_lsm > 0)
                   <span class="fa fa-sort-asc" style="color:green"></span>
                   @else
                   <span class="fa fa-sort-desc" style="color:red"></span>
                   @endif
                   )</sup></h3>
                  <p>Total LSM Earning Yesterday</p>
                </div>
                
                <div class="icon">
                  <i class="fa fa-circle-o-notch"></i>
                </div>
               
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><sup style="font-size: 20px">$</sup>{{$adsense_earn_yesterday}} <sup style="font-size: 20px">(${{$profit_adsense}}
                  @if ($profit_adsense == 0)
                   <span class="fa fa-ellipsis-h" style="color:yellow"></span>
                   @elseif($profit_adsense > 0)
                   <span class="fa fa-sort-asc" style="color:green"></span>
                   @else
                   <span class="fa fa-sort-desc" style="color:red"></span>
                   @endif
                   )</sup></h3>
                  <p>Total Adsense Earning Yesterday</p>
                </div>
                
                <div class="icon">
                  <i class="fa fa-google"></i>
                </div>
               
              </div>
            </div><!-- ./col -->
        
          </div>

