@extends('layouts.master')

@section('content')
  <div id="dashboard" class="d-flex">
    <div class="sidebar px-4">
      <form autocomplete="off">
        <h5 class="text-white"><strong>Filter Match</strong></h5>

        <div class="my-4 form-group">
          <input type="text" name="date" placeholder="Date" class="form-control" value="">
          
          <select name="schools" multiple>
            <option value="SMA Cibinong">SMA Cibinong</option>
          </select>

          <select name="states" multiple>
            <option value="SMA Cibinong">Cibinong</option>
          </select>

          <select name="gender" class="form-select">
            <option value="male">All Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>

          <button type="submit" class="btn btn-outline-white mt-5">Apply</button>
          <button type="reset" class="btn btn-outline-white">Reset</button>
        </div>
      </form>
    </div>

    <div class="pt-5 content w-100">
      <div class="d-flex justify-content-center align-items-center">
        {{-- Live Events --}}
        <div class="card text-center border-light schedule-card">
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
              <div class="nav-link active text-primary">
                  <strong>Live</strong>
                </div>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <h5 class="card-title">No Live Stream Currently</h5>
          </div>
        </div>
      </div>

      <div class="py-5"></div>

      {{-- Up Coming Events --}}
      <div class="d-flex justify-content-center align-items-center">
        <div class="card text-center border-light schedule-card">
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <div class="nav-link active text-primary">
                  <strong>Up Coming</strong>
                </div>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="card events-card">
              <div class="card-body text-start px-5">
                <div class="country pb-2 text-primary">
                  <div><strong>Belgium</strong></div>
                  <div><strong>Indonesia</strong></div>
                </div>

                <div class="detail pt-2 d-flex justify-content-between align-items-center">
                  <div>
                    <div><small>11 June 2020 - 10:00</small></div>
                    <div><small>Bogor</small></div>
                  </div>
                  <div class="text-end">
                    <div><small>Group B</small></div>
                    <div><small>Pakansari Stadion</small></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card events-card">
              <div class="card-body text-start px-5">
                <div class="country pb-2 text-primary">
                  <div><strong>Belgium</strong></div>
                  <div><strong>Indonesia</strong></div>
                </div>

                <div class="detail pt-2 d-flex justify-content-between align-items-center">
                  <div>
                    <div><small>11 June 2020 - 10:00</small></div>
                    <div><small>Bogor</small></div>
                  </div>
                  <div class="text-end">
                    <div><small>Group B</small></div>
                    <div><small>Pakansari Stadion</small></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card events-card">
              <div class="card-body text-start px-5">
                <div class="country pb-2 text-primary">
                  <div><strong>Belgium</strong></div>
                  <div><strong>Indonesia</strong></div>
                </div>

                <div class="detail pt-2 d-flex justify-content-between align-items-center">
                  <div>
                    <div><small>11 June 2020 - 10:00</small></div>
                    <div><small>Bogor</small></div>
                  </div>
                  <div class="text-end">
                    <div><small>Group B</small></div>
                    <div><small>Pakansari Stadion</small></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card events-card">
              <div class="card-body text-start px-5">
                <div class="country pb-2 text-primary">
                  <div><strong>Belgium</strong></div>
                  <div><strong>Indonesia</strong></div>
                </div>

                <div class="detail pt-2 d-flex justify-content-between align-items-center">
                  <div>
                    <div><small>11 June 2020 - 10:00</small></div>
                    <div><small>Bogor</small></div>
                  </div>
                  <div class="text-end">
                    <div><small>Group B</small></div>
                    <div><small>Pakansari Stadion</small></div>
                  </div>
                </div>
              </div>
            </div>

            <a href="#" class="btn btn-primary mt-4">
              Next&nbsp;
              <i class="fa-solid fa-angle-right"></i>
            </a>
            
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = {
        date: document.querySelector('input[name="date"]'),
      }

      // const datepicker = new Datepicker(form.date, {
      //   format: 'd MM yyyy'
      // });

      $(form.date).daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 2010,
        maxYear: parseInt(moment().format('YYYY'),10),
        autoUpdateInput: false,
        locale: {
          format: 'D MMMM YYYY'
        }
      }, function(start, end, label) {
        // var years = moment().diff(start, 'years');
        // alert("You are " + years + " years old!");
      }).on("apply.daterangepicker", function (e, picker) {
        picker.element.val(picker.startDate.format(picker.locale.format));
      });

      // $(form.date).on('changeDate', function (e) {
      //   let date = e.target.datepicker.dates[0]
      //   date = Datepicker.formatDate(date, 'yyyy-mm-dd');
      //   console.log(date)
      // })

      $('select[name="schools"]').select2({
        placeholder: "All Schools",
        theme: "bootstrap-5",
        width: 'style'
      })
      $('select[name="states"]').select2({
        placeholder: "All States",
        theme: "bootstrap-5",
        width: 'style'
      })
    })
  </script>
@endsection