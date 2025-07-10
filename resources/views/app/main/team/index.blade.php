<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Team</title>
    <link rel="stylesheet" href="{{ asset('static/index/v1/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('static/index/v1/css/team.css') }}">
    <link rel="stylesheet" href="{{ asset('static/loading/loading.css') }}">
  </head>
  <body>
    <div class="centeritem">
      <div class="flex_be header">
        <div class="flex_sta">
          <img class="backpage" src="{{ asset('uploads/material/back.png') }}" alt="">
          <h6>My Team</h6> <!-- Ensure the heading is visible here -->
        </div>
        <div class="balancebox">
          <div class="flex_re">
            <p>Balance</p>
            <img src="{{ asset('profelar/profelar_pay.png') }}" alt="">
          </div>
          <span>{{price(auth()->user()->balance)}}</span>
        </div>
      </div>
      <input type="hidden" id="TOKEN" value="6cb720c9f119f24dc0f0839136954252">
      <div class="myreferral">
        <div class="flex_be">
          <div class="flex_sta">
            <img src="{{ asset('uploads/material/level.png') }}" alt="">
            <p class="myre">My Referral:</p>
          </div>
          <div class="flex_sta valid">
            <span>Valid <span class="header_active_number_count"></span></span>
            <p class="myre header_total_number_count"></p>
          </div>
        </div>
        <div class="flex_be">
          <div class="income">
            <span class="header_total_money_number">{{price($totalCommission)}}</span>
            <p>Total Income</p>
          </div>
          <div class="linebar"></div>
          <div class="income">
            <span class="header_today_money_number">{{price($totalCommission)}}</span>
            <p>Today's Income</p>
          </div>
        </div>
      </div>
      <div class="aboutorder">
        <div class="flex_sta">
          <img src="{{ asset('uploads/material/tz.png') }}" alt="">
          <p>About My Team</p>
        </div>
        <p> You obtain 30% of your level 1 referrals' deposit amount as commission, 4% of level 2's, and 1% of Level 3's. </p>
      </div>
      <!-- Level Buttons -->
      <div class="manubox flex_be">
        <div class="levelbox active" onclick="showContent(0, this)">
          Level - 01
        </div>
        <div class="levelbox" onclick="showContent(1, this)">
          Level - 02
        </div>
        <div class="levelbox" onclick="showContent(2, this)">
          Level - 03
        </div>
      </div>

      <!-- Content for Level 1 -->
      <div id="team_content_0" class="content1">
        <div class="tableoutter">
          <table rules="all">
            <tbody>
              <tr>
                <th></th>
                <th>Referral</th>
                <th>totalDeposit</th>
                <th>totalWithdraw</th>
              </tr>
              <tr>
                <td>Total</td>
                <td><span>(Valid) <span class="level_active_number"></span></span> <br> {{$first_level_users->count()}}<span class="level_total_number"></span></td>
                <td class="total_money_number">{{price($totalDeposit1)}}</td>
                <td class="total_income_number">{{price($totalWithdraw1)}}</td>
              </tr>
              <tr>
                <td>Today</td>
                <td> <span>(Valid) <span class="level_day_active_number"></span></span> <br> {{$first_level_users->count()}}<span class="level_all_day_total_number"></span></td>
                <td class="today_money_number">{{price($totalDeposit1)}}</td>
                <td class="today_income_number">{{price($totalWithdraw1)}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!--<div class="flex_sta title">
          <img src="/uploads/material/infoicon.png" alt="">
          <h4>Referral Details</h4>
        </div>
        <div class="tableoutter desc-list">
          <table rules="all" class="recordes">
            <thead>
              <tr>
                <th>Time</th>
                <th>ID</th>
                <th>Deposit</th>
                <th>My Commission</th>
              </tr>
            </thead>
            <tbody class="data-list"></tbody>
          </table>
        </div>-->
        <div class="nothing empty" style="display: none;">
          <img src="{{ asset('uploads/material/nothing.png') }}" alt="">
          <p>NO Record</p>
        </div>
      </div>

      <!-- Content for Level 2 -->
      <div id="team_content_1" class="content2" style="display: none;">
        <div class="tableoutter">
          <table rules="all">
            <tbody>
              <tr>
                <th></th>
                <th>Referral</th>
                <th>Deposit</th>
                <th>Commission</th>
              </tr>
              <tr>
                <td>Total</td>
                <td><span>(Valid) <span class="level_active_number"></span></span> <br> {{$second_level_users->count()}}<span class="level_total_number"></span></td>
                <td class="total_money_number">{{price($totalDeposit2)}}</td>
                <td class="total_income_number">{{price($totalWithdraw2)}}</td>
              </tr>
              <tr>
                <td>Today</td>
                <td> <span>(Valid) <span class="level_day_active_number"></span></span> <br> {{$second_level_users->count()}}<span class="level_all_day_total_number"></span></td>
                <td class="today_money_number">{{price($totalDeposit2)}}</td>
                <td class="today_income_number">{{price($totalWithdraw2)}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="nothing empty" style="display: none;">
          <img src="{{ asset('uploads/material/nothing.png') }}" alt="">
          <p>NO Record</p>
        </div>
      </div>

      <!-- Content for Level 3 -->
      <div id="team_content_2" class="content3" style="display: none;">
        <div class="tableoutter">
          <table rules="all">
            <tbody>
              <tr>
                <th></th>
                <th>Referral</th>
                <th>Deposit</th>
                <th>Commission</th>
              </tr>
              <tr>
                <td>Total</td>
                <td><span>(Valid)</span> <br>{{$third_level_users->count()}}</td>
                <td>{{price($totalDeposit3)}}</td>
                <td>{{price($totalWithdraw3)}}</td>
              </tr>
              <tr>
                <td>Today</td>
                <td> <span>(Valid)</span> <br>{{$third_level_users->count()}}</td>
                <td>{{price($totalDeposit3)}}</td>
                <td>{{price($totalWithdraw3)}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="nothing empty" style="display: none;">
          <img src="{{ asset('uploads/material/nothing.png') }}" alt="">
          <p>NO Record</p>
        </div>
      </div>
    </div> <!-- End of centeritem -->
    

    <script>
      function showContent(level, element) {
        const levels = [0, 1, 2];
        levels.forEach(function(i) {
          const content = document.getElementById(`team_content_${i}`);
          if (i === level) {
            content.style.display = 'block';
          } else {
            content.style.display = 'none';
          }
        });

        // Remove 'active' class from all level buttons
        const buttons = document.querySelectorAll('.manubox .levelbox');
        buttons.forEach(button => {
          button.classList.remove('active');
        });

        // Add 'active' class to the clicked button
        element.classList.add('active');
      }

            // Display the first level content initially
      showContent(0, document.querySelector('.manubox .levelbox.active'));
    </script>
  </body>
</html>