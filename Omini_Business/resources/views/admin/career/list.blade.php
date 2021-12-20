@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
<style>
    .required:after {
        content: "*";
        color: red;
    }
    .error{
        color:red;
    }
table.dataTable tbody td {
    word-break: break-word;
    vertical-align: top;
}
.bootstrap-tagsinput .tag {
        background: #3bafda;
        border: 1px solid #3bafda;
        padding: 0 6px;
        margin-right: 2px;
        color: white;
        border-radius: 4px;
    }
    .bootstrap-tagsinput {
        width: 100% !important;
        height: calc(2.75rem + 2px) !important;
    }
    .select2-container{
        display: inline !important;
    }
    .dataTables_scrollBody
    {
    overflow-x:hidden !important;
    overflow-y:auto !important;
    }
</style>
<div class="app-content content">
    <div class="content-wrapper">
        <br>
        @include('alert.messages')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Careers</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-toggle="modal" data-target="#createResourceModal"  href="#" class="btn btn-success mr-1 mb-1 ladda-button" data-style="expand-left"><i class="ft-plus white"></i> <span class="ladda-label">Add Career</span></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table class="table table-striped table-bordered dom-jQuery-events dataTable" id="DataTables" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($list as $item)
                                    <tr role="row" class="odd">
                                        <td>{{$item->name}}</td>
                                        <td>@if($item->status==0) <i class="fa fa-thumbs-o-up"></i> Active @else <i class="fa fa-thumbs-o-down"></i> Inactive @endif</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li>
                                                    <a class="btn btn-primary text-white tab-order" data-toggle="modal" data-target="#editResourceModal{{$item->id}}"  href="#" title="Edit"><i class="icon-pencil"></i> Edit</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <div class="modal fade text-left show" id="editResourceModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" style="padding-right: 17px;">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h3 class="modal-title" id="myModalLabel35"> Edit Career</h3>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                              </button>
                                            </div>
                                            <form method="POST" action="{{url('admin/edit/career')}}/{{$item->id}}" enctype="multipart/form-data">
                                                @csrf
                                              <div class="modal-body">
                                                    <fieldset class="form-group floating-label-form-group">
                                                      <label for="email" class="label-control required">Title</label>
                                                      <input type="text" class="form-control" id="editname" name="editname" value="{{$item->name}}">
                                                        @if ($errors->has('editname'))
                                                            <span class="help-block">
                                                                <strong class="error">{{ $errors->first('editname') }}</strong>
                                                            </span>
                                                        @endif
                                                    </fieldset>
                                                    <fieldset class="form-group floating-label-form-group">
                                                        <label for="email" class="label-control required">No.of Openings</label>
                                                        <input type="number" class="form-control" id="editopening" name="editopening" value="{{$item->numbers}}">
                                                          @if ($errors->has('editopening'))
                                                              <span class="help-block">
                                                                  <strong class="error">{{ $errors->first('editopening') }}</strong>
                                                              </span>
                                                          @endif
                                                      </fieldset>
                                                    <fieldset class="form-group floating-label-form-group">
                                                        <label for="email" class="label-control required">Country</label>
                                                        <select name="editcountry" id="country" class="form-control" required>
                    
                                                            <option value="0" label="Select a country"  disabled="">Select a country</option>
                                              
                                                            <optgroup id="country-optgroup-Africa" label="Africa">
                                              
                                                            <option @if($item->country=="DZ") selected @else @endif value="DZ" label="Algeria">Algeria</option>
                                              
                                                            <option @if($item->country=="AO") selected @else @endif value="AO" label="Angola">Angola</option>
                                              
                                                            <option  @if($item->country=="BJ") selected @else @endif value="BJ" label="Benin">Benin</option>
                                              
                                                            <option  @if($item->country=="BW") selected @else @endif value="BW" label="Botswana">Botswana</option>
                                              
                                                            <option  @if($item->country=="BF") selected @else @endif value="BF" label="Burkina Faso">Burkina Faso</option>
                                              
                                                            <option  @if($item->country=="BI") selected @else @endif value="BI" label="Burundi">Burundi</option>
                                              
                                                            <option  @if($item->country=="CM") selected @else @endif value="CM" label="Cameroon">Cameroon</option>
                                              
                                                            <option   @if($item->country=="CV") selected @else @endif value="CV" label="Cape Verde">Cape Verde</option>
                                              
                                                            <option   @if($item->country=="CF") selected @else @endif value="CF" label="Central African Republic">Central African Republic</option>
                                              
                                                            <option   @if($item->country=="TD") selected @else @endif value="TD" label="Chad">Chad</option>
                                              
                                                            <option   @if($item->country=="KM") selected @else @endif value="KM" label="Comoros">Comoros</option>
                                              
                                                            <option   @if($item->country=="CG") selected @else @endif value="CG" label="Congo - Brazzaville">Congo - Brazzaville</option>
                                              
                                                            <option   @if($item->country=="CD") selected @else @endif value="CD" label="Congo - Kinshasa">Congo - Kinshasa</option>
                                              
                                                            <option   @if($item->country=="CI") selected @else @endif value="CI" label="Côte d’Ivoire">Côte d’Ivoire</option>
                                              
                                                            <option   @if($item->country=="DJ") selected @else @endif value="DJ" label="Djibouti">Djibouti</option>
                                              
                                                            <option   @if($item->country=="EG") selected @else @endif value="EG" label="Egypt">Egypt</option>
                                              
                                                            <option   @if($item->country=="GQ") selected @else @endif value="GQ" label="Equatorial Guinea">Equatorial Guinea</option>
                                              
                                                            <option   @if($item->country=="ER") selected @else @endif value="ER" label="Eritrea">Eritrea</option>
                                              
                                                            <option   @if($item->country=="ET") selected @else @endif value="ET" label="Ethiopia">Ethiopia</option>
                                              
                                                            <option   @if($item->country=="GA") selected @else @endif value="GA" label="Gabon">Gabon</option>
                                              
                                                            <option   @if($item->country=="GM") selected @else @endif value="GM" label="Gambia">Gambia</option>
                                              
                                                            <option   @if($item->country=="GH") selected @else @endif value="GH" label="Ghana">Ghana</option>
                                              
                                                            <option   @if($item->country=="GN") selected @else @endif value="GN" label="Guinea">Guinea</option>
                                              
                                                            <option   @if($item->country=="GW") selected @else @endif value="GW" label="Guinea-Bissau">Guinea-Bissau</option>
                                              
                                                            <option   @if($item->country=="KE") selected @else @endif value="KE" label="Kenya">Kenya</option>
                                              
                                                            <option   @if($item->country=="LS") selected @else @endif value="LS" label="Lesotho">Lesotho</option>
                                              
                                                            <option   @if($item->country=="LR") selected @else @endif value="LR" label="Liberia">Liberia</option>
                                              
                                                            <option   @if($item->country=="LY") selected @else @endif value="LY" label="Libya">Libya</option>
                                              
                                                            <option   @if($item->country=="MG") selected @else @endif value="MG" label="Madagascar">Madagascar</option>
                                              
                                                            <option   @if($item->country=="MW") selected @else @endif value="MW" label="Malawi">Malawi</option>
                                              
                                                            <option   @if($item->country=="ML") selected @else @endif value="ML" label="Mali">Mali</option>
                                              
                                                            <option   @if($item->country=="MR") selected @else @endif value="MR" label="Mauritania">Mauritania</option>
                                              
                                                            <option   @if($item->country=="MU") selected @else @endif value="MU" label="Mauritius">Mauritius</option>
                                              
                                                            <option   @if($item->country=="YT") selected @else @endif value="YT" label="Mayotte">Mayotte</option>
                                              
                                                            <option   @if($item->country=="MA") selected @else @endif value="MA" label="Morocco">Morocco</option>
                                              
                                                            <option   @if($item->country=="MZ") selected @else @endif value="MZ" label="Mozambique">Mozambique</option>
                                              
                                                            <option   @if($item->country=="NA") selected @else @endif value="NA" label="Namibia">Namibia</option>
                                              
                                                            <option   @if($item->country=="NE") selected @else @endif value="NE" label="Niger">Niger</option>
                                              
                                                            <option   @if($item->country=="NG") selected @else @endif value="NG" label="Nigeria">Nigeria</option>
                                              
                                                            <option   @if($item->country=="RW") selected @else @endif value="RW" label="Rwanda">Rwanda</option>
                                              
                                                            <option   @if($item->country=="RE") selected @else @endif value="RE" label="Réunion">Réunion</option>
                                              
                                                            <option   @if($item->country=="SH") selected @else @endif value="SH" label="Saint Helena">Saint Helena</option>
                                              
                                                            <option   @if($item->country=="SN") selected @else @endif value="SN" label="Senegal">Senegal</option>
                                              
                                                            <option   @if($item->country=="SC") selected @else @endif value="SC" label="Seychelles">Seychelles</option>
                                              
                                                            <option   @if($item->country=="SL") selected @else @endif value="SL" label="Sierra Leone">Sierra Leone</option>
                                              
                                                            <option   @if($item->country=="SO") selected @else @endif value="SO" label="Somalia">Somalia</option>
                                              
                                                            <option   @if($item->country=="ZA") selected @else @endif value="ZA" label="South Africa">South Africa</option>
                                              
                                                            <option   @if($item->country=="SD") selected @else @endif value="SD" label="Sudan">Sudan</option>
                                              
                                                            <option   @if($item->country=="SZ") selected @else @endif value="SZ" label="Swaziland">Swaziland</option>
                                              
                                                            <option   @if($item->country=="ST") selected @else @endif value="ST" label="São Tomé and Príncipe">São Tomé and Príncipe</option>
                                              
                                                            <option   @if($item->country=="TZ") selected @else @endif value="TZ" label="Tanzania">Tanzania</option>
                                              
                                                            <option   @if($item->country=="TG") selected @else @endif value="TG" label="Togo">Togo</option>
                                              
                                                            <option   @if($item->country=="TN") selected @else @endif value="TN" label="Tunisia">Tunisia</option>
                                              
                                                            <option   @if($item->country=="UG") selected @else @endif value="UG" label="Uganda">Uganda</option>
                                              
                                                            <option   @if($item->country=="EH") selected @else @endif value="EH" label="Western Sahara">Western Sahara</option>
                                              
                                                            <option   @if($item->country=="ZM") selected @else @endif value="ZM" label="Zambia">Zambia</option>
                                              
                                                            <option   @if($item->country=="ZW") selected @else @endif value="ZW" label="Zimbabwe">Zimbabwe</option>
                                              
                                                            </optgroup>
                                              
                                                            <optgroup id="country-optgroup-Americas" label="Americas">
                                              
                                                            <option   @if($item->country=="AI") selected @else @endif value="AI" label="Anguilla">Anguilla</option>
                                              
                                                            <option   @if($item->country=="AG") selected @else @endif value="AG" label="Antigua and Barbuda">Antigua and Barbuda</option>
                                              
                                                            <option   @if($item->country=="AR") selected @else @endif value="AR" label="Argentina">Argentina</option>
                                              
                                                            <option   @if($item->country=="AW") selected @else @endif value="AW" label="Aruba">Aruba</option>
                                              
                                                            <option   @if($item->country=="BS") selected @else @endif value="BS" label="Bahamas">Bahamas</option>
                                              
                                                            <option   @if($item->country=="BB") selected @else @endif value="BB" label="Barbados">Barbados</option>
                                              
                                                            <option   @if($item->country=="BZ") selected @else @endif value="BZ" label="Belize">Belize</option>
                                              
                                                            <option   @if($item->country=="BM") selected @else @endif value="BM" label="Bermuda">Bermuda</option>
                                              
                                                            <option   @if($item->country=="BO") selected @else @endif value="BO" label="Bolivia">Bolivia</option>
                                              
                                                            <option   @if($item->country=="BR") selected @else @endif value="BR" label="Brazil">Brazil</option>
                                              
                                                            <option   @if($item->country=="VG") selected @else @endif value="VG" label="British Virgin Islands">British Virgin Islands</option>
                                              
                                                            <option   @if($item->country=="CA") selected @else @endif value="CA" label="Canada">Canada</option>
                                              
                                                            <option   @if($item->country=="KY") selected @else @endif value="KY" label="Cayman Islands">Cayman Islands</option>
                                              
                                                            <option   @if($item->country=="CL") selected @else @endif value="CL" label="Chile">Chile</option>
                                              
                                                            <option   @if($item->country=="CO") selected @else @endif value="CO" label="Colombia">Colombia</option>
                                              
                                                            <option   @if($item->country=="CR") selected @else @endif value="CR" label="Costa Rica">Costa Rica</option>
                                              
                                                            <option   @if($item->country=="CU") selected @else @endif value="CU" label="Cuba">Cuba</option>
                                              
                                                            <option   @if($item->country=="DM") selected @else @endif value="DM" label="Dominica">Dominica</option>
                                              
                                                            <option   @if($item->country=="DO") selected @else @endif value="DO" label="Dominican Republic">Dominican Republic</option>
                                              
                                                            <option   @if($item->country=="EC") selected @else @endif value="EC" label="Ecuador">Ecuador</option>
                                              
                                                            <option   @if($item->country=="SV") selected @else @endif value="SV" label="El Salvador">El Salvador</option>
                                              
                                                            <option   @if($item->country=="FK") selected @else @endif value="FK" label="Falkland Islands">Falkland Islands</option>
                                              
                                                            <option   @if($item->country=="GF") selected @else @endif value="GF" label="French Guiana">French Guiana</option>
                                              
                                                            <option   @if($item->country=="GL") selected @else @endif value="GL" label="Greenland">Greenland</option>
                                              
                                                            <option   @if($item->country=="GD") selected @else @endif value="GD" label="Grenada">Grenada</option>
                                              
                                                            <option   @if($item->country=="GP") selected @else @endif value="GP" label="Guadeloupe">Guadeloupe</option>
                                              
                                                            <option   @if($item->country=="GT") selected @else @endif value="GT" label="Guatemala">Guatemala</option>
                                              
                                                            <option   @if($item->country=="GY") selected @else @endif value="GY" label="Guyana">Guyana</option>
                                              
                                                            <option   @if($item->country=="HT") selected @else @endif value="HT" label="Haiti">Haiti</option>
                                              
                                                            <option   @if($item->country=="HN") selected @else @endif value="HN" label="Honduras">Honduras</option>
                                              
                                                            <option   @if($item->country=="JM") selected @else @endif value="JM" label="Jamaica">Jamaica</option>
                                              
                                                            <option   @if($item->country=="MQ") selected @else @endif value="MQ" label="Martinique">Martinique</option>
                                              
                                                            <option   @if($item->country=="MX") selected @else @endif value="MX" label="Mexico">Mexico</option>
                                              
                                                            <option   @if($item->country=="MS") selected @else @endif value="MS" label="Montserrat">Montserrat</option>
                                              
                                                            <option   @if($item->country=="AN") selected @else @endif value="AN" label="Netherlands Antilles">Netherlands Antilles</option>
                                              
                                                            <option   @if($item->country=="NI") selected @else @endif value="NI" label="Nicaragua">Nicaragua</option>
                                              
                                                            <option   @if($item->country=="PA") selected @else @endif value="PA" label="Panama">Panama</option>
                                              
                                                            <option   @if($item->country=="PY") selected @else @endif value="PY" label="Paraguay">Paraguay</option>
                                              
                                                            <option   @if($item->country=="PE") selected @else @endif value="PE" label="Peru">Peru</option>
                                              
                                                            <option   @if($item->country=="PR") selected @else @endif value="PR" label="Puerto Rico">Puerto Rico</option>
                                              
                                                            <option   @if($item->country=="BL") selected @else @endif value="BL" label="Saint Barthélemy">Saint Barthélemy</option>
                                              
                                                            <option   @if($item->country=="KN") selected @else @endif value="KN" label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                              
                                                            <option   @if($item->country=="LC") selected @else @endif value="LC" label="Saint Lucia">Saint Lucia</option>
                                              
                                                            <option   @if($item->country=="MF") selected @else @endif value="MF" label="Saint Martin">Saint Martin</option>
                                              
                                                            <option   @if($item->country=="PM") selected @else @endif value="PM" label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                              
                                                            <option   @if($item->country=="VC") selected @else @endif value="VC" label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                              
                                                            <option   @if($item->country=="SR") selected @else @endif value="SR" label="Suriname">Suriname</option>
                                              
                                                            <option   @if($item->country=="TT") selected @else @endif value="TT" label="Trinidad and Tobago">Trinidad and Tobago</option>
                                              
                                                            <option   @if($item->country=="TC") selected @else @endif value="TC" label="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                              
                                                            <option   @if($item->country=="VI") selected @else @endif value="VI" label="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                              
                                                            <option   @if($item->country=="US") selected @else @endif value="US" label="United States">United States</option>
                                              
                                                            <option   @if($item->country=="UY") selected @else @endif value="UY" label="Uruguay">Uruguay</option>
                                              
                                                            <option   @if($item->country=="VE") selected @else @endif value="VE" label="Venezuela">Venezuela</option>
                                              
                                                            </optgroup>
                                              
                                                            <optgroup id="country-optgroup-Asia" label="Asia">
                                              
                                                            <option   @if($item->country=="AF") selected @else @endif value="AF" label="Afghanistan">Afghanistan</option>
                                              
                                                            <option   @if($item->country=="AM") selected @else @endif value="AM" label="Armenia">Armenia</option>
                                              
                                                            <option   @if($item->country=="AZ") selected @else @endif value="AZ" label="Azerbaijan">Azerbaijan</option>
                                              
                                                            <option   @if($item->country=="BH") selected @else @endif value="BH" label="Bahrain">Bahrain</option>
                                              
                                                            <option   @if($item->country=="BD") selected @else @endif value="BD" label="Bangladesh">Bangladesh</option>
                                              
                                                            <option   @if($item->country=="BT") selected @else @endif value="BT" label="Bhutan">Bhutan</option>
                                              
                                                            <option   @if($item->country=="BN") selected @else @endif value="BN" label="Brunei">Brunei</option>
                                              
                                                            <option   @if($item->country=="KH") selected @else @endif value="KH" label="Cambodia">Cambodia</option>
                                              
                                                            <option   @if($item->country=="CN") selected @else @endif value="CN" label="China">China</option>
                                              
                                                            <option   @if($item->country=="CY") selected @else @endif value="CY" label="Cyprus">Cyprus</option>
                                              
                                                            <option   @if($item->country=="GE") selected @else @endif value="GE" label="Georgia">Georgia</option>
                                              
                                                            <option   @if($item->country=="HK") selected @else @endif value="HK" label="Hong Kong SAR China">Hong Kong SAR China</option>
                                              
                                                            <option   @if($item->country=="IN") selected @else @endif value="IN" label="India">India</option>
                                              
                                                            <option   @if($item->country=="ID") selected @else @endif value="ID" label="Indonesia">Indonesia</option>
                                              
                                                            <option   @if($item->country=="IR") selected @else @endif value="IR" label="Iran">Iran</option>
                                              
                                                            <option   @if($item->country=="IQ") selected @else @endif value="IQ" label="Iraq">Iraq</option>
                                              
                                                            <option   @if($item->country=="IL") selected @else @endif value="IL" label="Israel">Israel</option>
                                              
                                                            <option   @if($item->country=="JP") selected @else @endif value="JP" label="Japan">Japan</option>
                                              
                                                            <option   @if($item->country=="JO") selected @else @endif value="JO" label="Jordan">Jordan</option>
                                              
                                                            <option   @if($item->country=="KZ") selected @else @endif value="KZ" label="Kazakhstan">Kazakhstan</option>
                                              
                                                            <option   @if($item->country=="KW") selected @else @endif value="KW" label="Kuwait">Kuwait</option>
                                              
                                                            <option   @if($item->country=="KG") selected @else @endif value="KG" label="Kyrgyzstan">Kyrgyzstan</option>
                                              
                                                            <option @if($item->country=="LA") selected @else @endif value="LA" label="Laos">Laos</option>
                                              
                                                            <option @if($item->country=="LB") selected @else @endif value="LB" label="Lebanon">Lebanon</option>
                                              
                                                            <option @if($item->country=="MO") selected @else @endif value="MO" label="Macau SAR China">Macau SAR China</option>
                                              
                                                            <option @if($item->country=="MY") selected @else @endif value="MY" label="Malaysia">Malaysia</option>
                                              
                                                            <option @if($item->country=="MV") selected @else @endif value="MV" label="Maldives">Maldives</option>
                                              
                                                            <option @if($item->country=="MN") selected @else @endif value="MN" label="Mongolia">Mongolia</option>
                                              
                                                            <option @if($item->country=="MM") selected @else @endif value="MM" label="Myanmar [Burma]">Myanmar [Burma]</option>
                                              
                                                            <option  @if($item->country=="NP") selected @else @endif value="NP" label="Nepal">Nepal</option>
                                              
                                                            <option  @if($item->country=="NT") selected @else @endif value="NT" label="Neutral Zone">Neutral Zone</option>
                                              
                                                            <option  @if($item->country=="KP") selected @else @endif value="KP" label="North Korea">North Korea</option>
                                              
                                                            <option @if($item->country=="OM") selected @else @endif  value="OM" label="Oman">Oman</option>
                                              
                                                            <option  @if($item->country=="PK") selected @else @endif value="PK" label="Pakistan">Pakistan</option>
                                              
                                                            <option  @if($item->country=="PS") selected @else @endif value="PS" label="Palestinian Territories">Palestinian Territories</option>
                                              
                                                            <option  @if($item->country=="YD") selected @else @endif value="YD" label="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                                              
                                                            <option  @if($item->country=="PH") selected @else @endif value="PH" label="Philippines">Philippines</option>
                                              
                                                            <option  @if($item->country=="QA") selected @else @endif value="QA" label="Qatar">Qatar</option>
                                              
                                                            <option @if($item->country=="SA") selected @else @endif  value="SA" label="Saudi Arabia">Saudi Arabia</option>
                                              
                                                            <option  @if($item->country=="SG") selected @else @endif value="SG" label="Singapore">Singapore</option>
                                              
                                                            <option  @if($item->country=="KR") selected @else @endif value="KR" label="South Korea">South Korea</option>
                                              
                                                            <option  @if($item->country=="LK") selected @else @endif value="LK" label="Sri Lanka">Sri Lanka</option>
                                              
                                                            <option  @if($item->country=="SY") selected @else @endif value="SY" label="Syria">Syria</option>
                                              
                                                            <option  @if($item->country=="TW") selected @else @endif value="TW" label="Taiwan">Taiwan</option>
                                              
                                                            <option  @if($item->country=="TJ") selected @else @endif value="TJ" label="Tajikistan">Tajikistan</option>
                                              
                                                            <option  @if($item->country=="TH") selected @else @endif value="TH" label="Thailand">Thailand</option>
                                              
                                                            <option  @if($item->country=="TL") selected @else @endif value="TL" label="Timor-Leste">Timor-Leste</option>
                                              
                                                            <option  @if($item->country=="TR") selected @else @endif value="TR" label="Turkey">Turkey</option>
                                              
                                                            <option  @if($item->country=="™") selected @else @endif value="™" label="Turkmenistan">Turkmenistan</option>
                                              
                                                            <option  @if($item->country=="AE") selected @else @endif value="AE" label="United Arab Emirates">United Arab Emirates</option>
                                              
                                                            <option @if($item->country=="UZ") selected @else @endif  value="UZ" label="Uzbekistan">Uzbekistan</option>
                                              
                                                            <option @if($item->country=="VN") selected @else @endif  value="VN" label="Vietnam">Vietnam</option>
                                              
                                                            <option  @if($item->country=="YE") selected @else @endif value="YE" label="Yemen">Yemen</option>
                                              
                                                            </optgroup>
                                              
                                                            <optgroup id="country-optgroup-Europe" label="Europe">
                                              
                                                            <option @if($item->country=="AL") selected @else @endif  value="AL" label="Albania">Albania</option>
                                              
                                                            <option  @if($item->country=="AD") selected @else @endif value="AD" label="Andorra">Andorra</option>
                                              
                                                            <option  @if($item->country=="AT") selected @else @endif value="AT" label="Austria">Austria</option>
                                              
                                                            <option  @if($item->country=="BY") selected @else @endif value="BY" label="Belarus">Belarus</option>
                                              
                                                            <option  @if($item->country=="BE") selected @else @endif value="BE" label="Belgium">Belgium</option>
                                              
                                                            <option  @if($item->country=="BA") selected @else @endif value="BA" label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                              
                                                            <option  @if($item->country=="BG") selected @else @endif value="BG" label="Bulgaria">Bulgaria</option>
                                              
                                                            <option  @if($item->country=="HR") selected @else @endif value="HR" label="Croatia">Croatia</option>
                                              
                                                            <option  @if($item->country=="CY") selected @else @endif value="CY" label="Cyprus">Cyprus</option>
                                              
                                                            <option @if($item->country=="CZ") selected @else @endif value="CZ" label="Czech Republic">Czech Republic</option>
                                              
                                                            <option  @if($item->country=="DK") selected @else @endif value="DK" label="Denmark">Denmark</option>
                                              
                                                            <option  @if($item->country=="DD") selected @else @endif value="DD" label="East Germany">East Germany</option>
                                              
                                                            <option  @if($item->country=="EE") selected @else @endif value="EE" label="Estonia">Estonia</option>
                                              
                                                            <option  @if($item->country=="FO") selected @else @endif value="FO" label="Faroe Islands">Faroe Islands</option>
                                              
                                                            <option  @if($item->country=="FI") selected @else @endif value="FI" label="Finland">Finland</option>
                                              
                                                            <option  @if($item->country=="FR") selected @else @endif value="FR" label="France">France</option>
                                              
                                                            <option  @if($item->country=="DE") selected @else @endif value="DE" label="Germany">Germany</option>
                                              
                                                            <option  @if($item->country=="GI") selected @else @endif value="GI" label="Gibraltar">Gibraltar</option>
                                              
                                                            <option  @if($item->country=="GR") selected @else @endif value="GR" label="Greece">Greece</option>
                                              
                                                            <option  @if($item->country=="GG") selected @else @endif value="GG" label="Guernsey">Guernsey</option>
                                              
                                                            <option  @if($item->country=="HU") selected @else @endif value="HU" label="Hungary">Hungary</option>
                                              
                                                            <option  @if($item->country=="IS") selected @else @endif value="IS" label="Iceland">Iceland</option>
                                              
                                                            <option  @if($item->country=="IE") selected @else @endif value="IE" label="Ireland">Ireland</option>
                                              
                                                            <option  @if($item->country=="IM") selected @else @endif value="IM" label="Isle of Man">Isle of Man</option>
                                              
                                                            <option  @if($item->country=="IT") selected @else @endif value="IT" label="Italy">Italy</option>
                                              
                                                            <option  @if($item->country=="JE") selected @else @endif value="JE" label="Jersey">Jersey</option>
                                              
                                                            <option  @if($item->country=="LV") selected @else @endif value="LV" label="Latvia">Latvia</option>
                                              
                                                            <option  @if($item->country=="LI") selected @else @endif value="LI" label="Liechtenstein">Liechtenstein</option>
                                              
                                                            <option  @if($item->country=="LT") selected @else @endif value="LT" label="Lithuania">Lithuania</option>
                                              
                                                            <option  @if($item->country=="LU") selected @else @endif  value="LU" label="Luxembourg">Luxembourg</option>
                                              
                                                            <option  @if($item->country=="MK") selected @else @endif  value="MK" label="Macedonia">Macedonia</option>
                                              
                                                            <option  @if($item->country=="MT") selected @else @endif  value="MT" label="Malta">Malta</option>
                                              
                                                            <option   @if($item->country=="FX") selected @else @endif value="FX" label="Metropolitan France">Metropolitan France</option>
                                              
                                                            <option   @if($item->country=="MD") selected @else @endif value="MD" label="Moldova">Moldova</option>
                                              
                                                            <option  @if($item->country=="MC") selected @else @endif  value="MC" label="Monaco">Monaco</option>
                                              
                                                            <option  @if($item->country=="ME") selected @else @endif  value="ME" label="Montenegro">Montenegro</option>
                                              
                                                            <option  @if($item->country=="NL") selected @else @endif  value="NL" label="Netherlands">Netherlands</option>
                                              
                                                            <option  @if($item->country=="NO") selected @else @endif  value="NO" label="Norway">Norway</option>
                                              
                                                            <option  @if($item->country=="PL") selected @else @endif  value="PL" label="Poland">Poland</option>
                                              
                                                            <option   @if($item->country=="PT") selected @else @endif value="PT" label="Portugal">Portugal</option>
                                              
                                                            <option   @if($item->country=="RO") selected @else @endif value="RO" label="Romania">Romania</option>
                                              
                                                            <option   @if($item->country=="RU") selected @else @endif value="RU" label="Russia">Russia</option>
                                              
                                                            <option   @if($item->country=="SM") selected @else @endif value="SM" label="San Marino">San Marino</option>
                                              
                                                            <option   @if($item->country=="RS") selected @else @endif value="RS" label="Serbia">Serbia</option>
                                              
                                                            <option   @if($item->country=="CS") selected @else @endif value="CS" label="Serbia and Montenegro">Serbia and Montenegro</option>
                                              
                                                            <option   @if($item->country=="SK") selected @else @endif value="SK" label="Slovakia">Slovakia</option>
                                              
                                                            <option   @if($item->country=="SI") selected @else @endif value="SI" label="Slovenia">Slovenia</option>
                                              
                                                            <option   @if($item->country=="ES") selected @else @endif value="ES" label="Spain">Spain</option>
                                              
                                                            <option   @if($item->country=="SJ") selected @else @endif value="SJ" label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                              
                                                            <option   @if($item->country=="SE") selected @else @endif value="SE" label="Sweden">Sweden</option>
                                              
                                                            <option   @if($item->country=="CH") selected @else @endif value="CH" label="Switzerland">Switzerland</option>
                                              
                                                            <option   @if($item->country=="UA") selected @else @endif value="UA" label="Ukraine">Ukraine</option>
                                              
                                                            <option  @if($item->country=="SU") selected @else @endif  value="SU" label="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                                              
                                                            <option  @if($item->country=="GB") selected @else @endif  value="GB" label="United Kingdom">United Kingdom</option>
                                              
                                                            <option   @if($item->country=="VA") selected @else @endif value="VA" label="Vatican City">Vatican City</option>
                                              
                                                            <option  @if($item->country=="AX") selected @else @endif  value="AX" label="Åland Islands">Åland Islands</option>
                                              
                                                            </optgroup>
                                              
                                                            <optgroup id="country-optgroup-Oceania" label="Oceania">
                                              
                                                            <option  @if($item->country=="AS") selected @else @endif  value="AS" label="American Samoa">American Samoa</option>
                                              
                                                            <option  @if($item->country=="AQ") selected @else @endif  value="AQ" label="Antarctica">Antarctica</option>
                                              
                                                            <option   @if($item->country=="AU") selected @else @endif value="AU" label="Australia">Australia</option>
                                              
                                                            <option   @if($item->country=="BV") selected @else @endif value="BV" label="Bouvet Island">Bouvet Island</option>
                                              
                                                            <option   @if($item->country=="IO") selected @else @endif value="IO" label="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                              
                                                            <option   @if($item->country=="CX") selected @else @endif value="CX" label="Christmas Island">Christmas Island</option>
                                              
                                                            <option   @if($item->country=="CC") selected @else @endif value="CC" label="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>
                                              
                                                            <option   @if($item->country=="CK") selected @else @endif value="CK" label="Cook Islands">Cook Islands</option>
                                              
                                                            <option   @if($item->country=="FJ") selected @else @endif value="FJ" label="Fiji">Fiji</option>
                                              
                                                            <option   @if($item->country=="PF") selected @else @endif value="PF" label="French Polynesia">French Polynesia</option>
                                              
                                                            <option   @if($item->country=="TF") selected @else @endif value="TF" label="French Southern Territories">French Southern Territories</option>
                                              
                                                            <option   @if($item->country=="GU") selected @else @endif value="GU" label="Guam">Guam</option>
                                              
                                                            <option   @if($item->country=="HM") selected @else @endif value="HM" label="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                              
                                                            <option   @if($item->country=="KI") selected @else @endif value="KI" label="Kiribati">Kiribati</option>
                                              
                                                            <option   @if($item->country=="MH") selected @else @endif value="MH" label="Marshall Islands">Marshall Islands</option>
                                              
                                                            <option   @if($item->country=="FM") selected @else @endif value="FM" label="Micronesia">Micronesia</option>
                                              
                                                            <option   @if($item->country=="NR") selected @else @endif value="NR" label="Nauru">Nauru</option>
                                              
                                                            <option   @if($item->country=="NC") selected @else @endif value="NC" label="New Caledonia">New Caledonia</option>
                                              
                                                            <option   @if($item->country=="NZ") selected @else @endif value="NZ" label="New Zealand">New Zealand</option>
                                              
                                                            <option  @if($item->country=="NU") selected @else @endif  value="NU" label="Niue">Niue</option>
                                              
                                                            <option   @if($item->country=="NF") selected @else @endif value="NF" label="Norfolk Island">Norfolk Island</option>
                                              
                                                            <option   @if($item->country=="MP") selected @else @endif value="MP" label="Northern Mariana Islands">Northern Mariana Islands</option>
                                              
                                                            <option   @if($item->country=="PW") selected @else @endif value="PW" label="Palau">Palau</option>
                                              
                                                            <option   @if($item->country=="PG") selected @else @endif value="PG" label="Papua New Guinea">Papua New Guinea</option>
                                              
                                                            <option   @if($item->country=="PN") selected @else @endif value="PN" label="Pitcairn Islands">Pitcairn Islands</option>
                                              
                                                            <option   @if($item->country=="WS") selected @else @endif value="WS" label="Samoa">Samoa</option>
                                              
                                                            <option   @if($item->country=="SB") selected @else @endif value="SB" label="Solomon Islands">Solomon Islands</option>
                                              
                                                            <option   @if($item->country=="GS") selected @else @endif value="GS" label="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                              
                                                            <option   @if($item->country=="TK") selected @else @endif value="TK" label="Tokelau">Tokelau</option>
                                              
                                                            <option   @if($item->country=="TO") selected @else @endif value="TO" label="Tonga">Tonga</option>
                                              
                                                            <option   @if($item->country=="TV") selected @else @endif value="TV" label="Tuvalu">Tuvalu</option>
                                              
                                                            <option   @if($item->country=="UM") selected @else @endif value="UM" label="U.S. Minor Outlying Islands">U.S. Minor Outlying Islands</option>
                                              
                                                            <option   @if($item->country=="VU") selected @else @endif value="VU" label="Vanuatu">Vanuatu</option>
                                              
                                                            <option   @if($item->country=="WF") selected @else @endif value="WF" label="Wallis and Futuna">Wallis and Futuna</option>
                                              
                                                            </optgroup>
                                              
                                                          </select>
                                                          @if ($errors->has('editcountry'))
                                                              <span class="help-block">
                                                                  <strong class="error">{{ $errors->first('editcountry') }}</strong>
                                                              </span>
                                                          @endif
                                                    </fieldset>
                                                    <fieldset class="form-group floating-label-form-group">
                                                        <label for="email" class="label-control">Career Details</label>
                                                        <textarea cols="30" rows="15" class="form-control detail2" id="detail2{{$item->id}}" name="detail2" placeholder="Details about career">{!! $item->detail !!}</textarea>
                                                            @if ($errors->has('detail2'))
                                                                <span class="help-block">
                                                                    <strong class="error">{{ $errors->first('detail2') }}</strong>
                                                                </span>
                                                            @endif
                                                    </fieldset>
                                                    <fieldset class="form-group floating-label-form-group">
                                                        <label class="label-control required">Last Date </label>
                                                        <input type="date" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo date('Y-m-d',strtotime($item->date)) ?>">
                                                            @if ($errors->has('date'))
                                                                <span class="help-block">
                                                                    <strong class="error">{{ $errors->first('date') }}</strong>
                                                                </span>
                                                            @endif
                                                    </fieldset>
                                                    <fieldset class="form-group floating-label-form-group">
                                                        <label class="label-control required">Status </label>
                                                        <select class="form-control" name="status">
                                                            <option value="0" @if($item->status)  selected @else @endif>Active</option>
                                                            <option value="1" @if($item->status) selected @else @endif>Inactive</option>
                                                        </select>
                                                    </fieldset>

                                              </div>
                                              <div class="modal-footer">
                                                  <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="close">
                                                  <input type="submit" class="btn btn-outline-primary btn-lg" value="Update">
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                    </div>
                                    @empty
                                    @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade text-left show" id="createResourceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" style="padding-right: 17px;">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="myModalLabel35"> Create Career</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <form method="POST" action="{{url('admin/add/career')}}" enctype="multipart/form-data">
                                @csrf
                              <div class="modal-body">
                                  <fieldset class="form-group floating-label-form-group">
                                      <label for="email" class="label-control required">Career Title</label>
                                      <input type="text" class="form-control" id="name" name="name" placeholder="Career Title">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong class="error">{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                  </fieldset>
                                  <fieldset class="form-group floating-label-form-group">
                                    <label for="email" class="label-control required">No.of Openings</label>
                                    <input type="number" class="form-control" id="opening" name="opening">
                                      @if ($errors->has('opening'))
                                          <span class="help-block">
                                              <strong class="error">{{ $errors->first('opening') }}</strong>
                                          </span>
                                      @endif
                                  </fieldset>
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="email" class="label-control required">Country</label>
                                    <select name="country" id="country" class="form-control" required>

                                        <option value="0" label="Select a country" selected="" disabled="">Select a country</option>
                        
                                        <optgroup id="country-optgroup-Africa" label="Africa">
                        
                                        <option value="DZ" label="Algeria">Algeria</option>
                        
                                        <option value="AO" label="Angola">Angola</option>
                        
                                        <option value="BJ" label="Benin">Benin</option>
                        
                                        <option value="BW" label="Botswana">Botswana</option>
                        
                                        <option value="BF" label="Burkina Faso">Burkina Faso</option>
                        
                                        <option value="BI" label="Burundi">Burundi</option>
                        
                                        <option value="CM" label="Cameroon">Cameroon</option>
                        
                                        <option value="CV" label="Cape Verde">Cape Verde</option>
                        
                                        <option value="CF" label="Central African Republic">Central African Republic</option>
                        
                                        <option value="TD" label="Chad">Chad</option>
                        
                                        <option value="KM" label="Comoros">Comoros</option>
                        
                                        <option value="CG" label="Congo - Brazzaville">Congo - Brazzaville</option>
                        
                                        <option value="CD" label="Congo - Kinshasa">Congo - Kinshasa</option>
                        
                                        <option value="CI" label="Côte d’Ivoire">Côte d’Ivoire</option>
                        
                                        <option value="DJ" label="Djibouti">Djibouti</option>
                        
                                        <option value="EG" label="Egypt">Egypt</option>
                        
                                        <option value="GQ" label="Equatorial Guinea">Equatorial Guinea</option>
                        
                                        <option value="ER" label="Eritrea">Eritrea</option>
                        
                                        <option value="ET" label="Ethiopia">Ethiopia</option>
                        
                                        <option value="GA" label="Gabon">Gabon</option>
                        
                                        <option value="GM" label="Gambia">Gambia</option>
                        
                                        <option value="GH" label="Ghana">Ghana</option>
                        
                                        <option value="GN" label="Guinea">Guinea</option>
                        
                                        <option value="GW" label="Guinea-Bissau">Guinea-Bissau</option>
                        
                                        <option value="KE" label="Kenya">Kenya</option>
                        
                                        <option value="LS" label="Lesotho">Lesotho</option>
                        
                                        <option value="LR" label="Liberia">Liberia</option>
                        
                                        <option value="LY" label="Libya">Libya</option>
                        
                                        <option value="MG" label="Madagascar">Madagascar</option>
                        
                                        <option value="MW" label="Malawi">Malawi</option>
                        
                                        <option value="ML" label="Mali">Mali</option>
                        
                                        <option value="MR" label="Mauritania">Mauritania</option>
                        
                                        <option value="MU" label="Mauritius">Mauritius</option>
                        
                                        <option value="YT" label="Mayotte">Mayotte</option>
                        
                                        <option value="MA" label="Morocco">Morocco</option>
                        
                                        <option value="MZ" label="Mozambique">Mozambique</option>
                        
                                        <option value="NA" label="Namibia">Namibia</option>
                        
                                        <option value="NE" label="Niger">Niger</option>
                        
                                        <option value="NG" label="Nigeria">Nigeria</option>
                        
                                        <option value="RW" label="Rwanda">Rwanda</option>
                        
                                        <option value="RE" label="Réunion">Réunion</option>
                        
                                        <option value="SH" label="Saint Helena">Saint Helena</option>
                        
                                        <option value="SN" label="Senegal">Senegal</option>
                        
                                        <option value="SC" label="Seychelles">Seychelles</option>
                        
                                        <option value="SL" label="Sierra Leone">Sierra Leone</option>
                        
                                        <option value="SO" label="Somalia">Somalia</option>
                        
                                        <option value="ZA" label="South Africa">South Africa</option>
                        
                                        <option value="SD" label="Sudan">Sudan</option>
                        
                                        <option value="SZ" label="Swaziland">Swaziland</option>
                        
                                        <option value="ST" label="São Tomé and Príncipe">São Tomé and Príncipe</option>
                        
                                        <option value="TZ" label="Tanzania">Tanzania</option>
                        
                                        <option value="TG" label="Togo">Togo</option>
                        
                                        <option value="TN" label="Tunisia">Tunisia</option>
                        
                                        <option value="UG" label="Uganda">Uganda</option>
                        
                                        <option value="EH" label="Western Sahara">Western Sahara</option>
                        
                                        <option value="ZM" label="Zambia">Zambia</option>
                        
                                        <option value="ZW" label="Zimbabwe">Zimbabwe</option>
                        
                                        </optgroup>
                        
                                        <optgroup id="country-optgroup-Americas" label="Americas">
                        
                                        <option value="AI" label="Anguilla">Anguilla</option>
                        
                                        <option value="AG" label="Antigua and Barbuda">Antigua and Barbuda</option>
                        
                                        <option value="AR" label="Argentina">Argentina</option>
                        
                                        <option value="AW" label="Aruba">Aruba</option>
                        
                                        <option value="BS" label="Bahamas">Bahamas</option>
                        
                                        <option value="BB" label="Barbados">Barbados</option>
                        
                                        <option value="BZ" label="Belize">Belize</option>
                        
                                        <option value="BM" label="Bermuda">Bermuda</option>
                        
                                        <option value="BO" label="Bolivia">Bolivia</option>
                        
                                        <option value="BR" label="Brazil">Brazil</option>
                        
                                        <option value="VG" label="British Virgin Islands">British Virgin Islands</option>
                        
                                        <option value="CA" label="Canada">Canada</option>
                        
                                        <option value="KY" label="Cayman Islands">Cayman Islands</option>
                        
                                        <option value="CL" label="Chile">Chile</option>
                        
                                        <option value="CO" label="Colombia">Colombia</option>
                        
                                        <option value="CR" label="Costa Rica">Costa Rica</option>
                        
                                        <option value="CU" label="Cuba">Cuba</option>
                        
                                        <option value="DM" label="Dominica">Dominica</option>
                        
                                        <option value="DO" label="Dominican Republic">Dominican Republic</option>
                        
                                        <option value="EC" label="Ecuador">Ecuador</option>
                        
                                        <option value="SV" label="El Salvador">El Salvador</option>
                        
                                        <option value="FK" label="Falkland Islands">Falkland Islands</option>
                        
                                        <option value="GF" label="French Guiana">French Guiana</option>
                        
                                        <option value="GL" label="Greenland">Greenland</option>
                        
                                        <option value="GD" label="Grenada">Grenada</option>
                        
                                        <option value="GP" label="Guadeloupe">Guadeloupe</option>
                        
                                        <option value="GT" label="Guatemala">Guatemala</option>
                        
                                        <option value="GY" label="Guyana">Guyana</option>
                        
                                        <option value="HT" label="Haiti">Haiti</option>
                        
                                        <option value="HN" label="Honduras">Honduras</option>
                        
                                        <option value="JM" label="Jamaica">Jamaica</option>
                        
                                        <option value="MQ" label="Martinique">Martinique</option>
                        
                                        <option value="MX" label="Mexico">Mexico</option>
                        
                                        <option value="MS" label="Montserrat">Montserrat</option>
                        
                                        <option value="AN" label="Netherlands Antilles">Netherlands Antilles</option>
                        
                                        <option value="NI" label="Nicaragua">Nicaragua</option>
                        
                                        <option value="PA" label="Panama">Panama</option>
                        
                                        <option value="PY" label="Paraguay">Paraguay</option>
                        
                                        <option value="PE" label="Peru">Peru</option>
                        
                                        <option value="PR" label="Puerto Rico">Puerto Rico</option>
                        
                                        <option value="BL" label="Saint Barthélemy">Saint Barthélemy</option>
                        
                                        <option value="KN" label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        
                                        <option value="LC" label="Saint Lucia">Saint Lucia</option>
                        
                                        <option value="MF" label="Saint Martin">Saint Martin</option>
                        
                                        <option value="PM" label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        
                                        <option value="VC" label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                        
                                        <option value="SR" label="Suriname">Suriname</option>
                        
                                        <option value="TT" label="Trinidad and Tobago">Trinidad and Tobago</option>
                        
                                        <option value="TC" label="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        
                                        <option value="VI" label="U.S. Virgin Islands">U.S. Virgin Islands</option>
                        
                                        <option value="US" label="United States">United States</option>
                        
                                        <option value="UY" label="Uruguay">Uruguay</option>
                        
                                        <option value="VE" label="Venezuela">Venezuela</option>
                        
                                        </optgroup>
                        
                                        <optgroup id="country-optgroup-Asia" label="Asia">
                        
                                        <option value="AF" label="Afghanistan">Afghanistan</option>
                        
                                        <option value="AM" label="Armenia">Armenia</option>
                        
                                        <option value="AZ" label="Azerbaijan">Azerbaijan</option>
                        
                                        <option value="BH" label="Bahrain">Bahrain</option>
                        
                                        <option value="BD" label="Bangladesh">Bangladesh</option>
                        
                                        <option value="BT" label="Bhutan">Bhutan</option>
                        
                                        <option value="BN" label="Brunei">Brunei</option>
                        
                                        <option value="KH" label="Cambodia">Cambodia</option>
                        
                                        <option value="CN" label="China">China</option>
                        
                                        <option value="CY" label="Cyprus">Cyprus</option>
                        
                                        <option value="GE" label="Georgia">Georgia</option>
                        
                                        <option value="HK" label="Hong Kong SAR China">Hong Kong SAR China</option>
                        
                                        <option value="IN" label="India">India</option>
                        
                                        <option value="ID" label="Indonesia">Indonesia</option>
                        
                                        <option value="IR" label="Iran">Iran</option>
                        
                                        <option value="IQ" label="Iraq">Iraq</option>
                        
                                        <option value="IL" label="Israel">Israel</option>
                        
                                        <option value="JP" label="Japan">Japan</option>
                        
                                        <option value="JO" label="Jordan">Jordan</option>
                        
                                        <option value="KZ" label="Kazakhstan">Kazakhstan</option>
                        
                                        <option value="KW" label="Kuwait">Kuwait</option>
                        
                                        <option value="KG" label="Kyrgyzstan">Kyrgyzstan</option>
                        
                                        <option value="LA" label="Laos">Laos</option>
                        
                                        <option value="LB" label="Lebanon">Lebanon</option>
                        
                                        <option value="MO" label="Macau SAR China">Macau SAR China</option>
                        
                                        <option value="MY" label="Malaysia">Malaysia</option>
                        
                                        <option value="MV" label="Maldives">Maldives</option>
                        
                                        <option value="MN" label="Mongolia">Mongolia</option>
                        
                                        <option value="MM" label="Myanmar [Burma]">Myanmar [Burma]</option>
                        
                                        <option value="NP" label="Nepal">Nepal</option>
                        
                                        <option value="NT" label="Neutral Zone">Neutral Zone</option>
                        
                                        <option value="KP" label="North Korea">North Korea</option>
                        
                                        <option value="OM" label="Oman">Oman</option>
                        
                                        <option value="PK" label="Pakistan">Pakistan</option>
                        
                                        <option value="PS" label="Palestinian Territories">Palestinian Territories</option>
                        
                                        <option value="YD" label="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                        
                                        <option value="PH" label="Philippines">Philippines</option>
                        
                                        <option value="QA" label="Qatar">Qatar</option>
                        
                                        <option value="SA" label="Saudi Arabia">Saudi Arabia</option>
                        
                                        <option value="SG" label="Singapore">Singapore</option>
                        
                                        <option value="KR" label="South Korea">South Korea</option>
                        
                                        <option value="LK" label="Sri Lanka">Sri Lanka</option>
                        
                                        <option value="SY" label="Syria">Syria</option>
                        
                                        <option value="TW" label="Taiwan">Taiwan</option>
                        
                                        <option value="TJ" label="Tajikistan">Tajikistan</option>
                        
                                        <option value="TH" label="Thailand">Thailand</option>
                        
                                        <option value="TL" label="Timor-Leste">Timor-Leste</option>
                        
                                        <option value="TR" label="Turkey">Turkey</option>
                        
                                        <option value="™" label="Turkmenistan">Turkmenistan</option>
                        
                                        <option value="AE" label="United Arab Emirates">United Arab Emirates</option>
                        
                                        <option value="UZ" label="Uzbekistan">Uzbekistan</option>
                        
                                        <option value="VN" label="Vietnam">Vietnam</option>
                        
                                        <option value="YE" label="Yemen">Yemen</option>
                        
                                        </optgroup>
                        
                                        <optgroup id="country-optgroup-Europe" label="Europe">
                        
                                        <option value="AL" label="Albania">Albania</option>
                        
                                        <option value="AD" label="Andorra">Andorra</option>
                        
                                        <option value="AT" label="Austria">Austria</option>
                        
                                        <option value="BY" label="Belarus">Belarus</option>
                        
                                        <option value="BE" label="Belgium">Belgium</option>
                        
                                        <option value="BA" label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        
                                        <option value="BG" label="Bulgaria">Bulgaria</option>
                        
                                        <option value="HR" label="Croatia">Croatia</option>
                        
                                        <option value="CY" label="Cyprus">Cyprus</option>
                        
                                        <option value="CZ" label="Czech Republic">Czech Republic</option>
                        
                                        <option value="DK" label="Denmark">Denmark</option>
                        
                                        <option value="DD" label="East Germany">East Germany</option>
                        
                                        <option value="EE" label="Estonia">Estonia</option>
                        
                                        <option value="FO" label="Faroe Islands">Faroe Islands</option>
                        
                                        <option value="FI" label="Finland">Finland</option>
                        
                                        <option value="FR" label="France">France</option>
                        
                                        <option value="DE" label="Germany">Germany</option>
                        
                                        <option value="GI" label="Gibraltar">Gibraltar</option>
                        
                                        <option value="GR" label="Greece">Greece</option>
                        
                                        <option value="GG" label="Guernsey">Guernsey</option>
                        
                                        <option value="HU" label="Hungary">Hungary</option>
                        
                                        <option value="IS" label="Iceland">Iceland</option>
                        
                                        <option value="IE" label="Ireland">Ireland</option>
                        
                                        <option value="IM" label="Isle of Man">Isle of Man</option>
                        
                                        <option value="IT" label="Italy">Italy</option>
                        
                                        <option value="JE" label="Jersey">Jersey</option>
                        
                                        <option value="LV" label="Latvia">Latvia</option>
                        
                                        <option value="LI" label="Liechtenstein">Liechtenstein</option>
                        
                                        <option value="LT" label="Lithuania">Lithuania</option>
                        
                                        <option value="LU" label="Luxembourg">Luxembourg</option>
                        
                                        <option value="MK" label="Macedonia">Macedonia</option>
                        
                                        <option value="MT" label="Malta">Malta</option>
                        
                                        <option value="FX" label="Metropolitan France">Metropolitan France</option>
                        
                                        <option value="MD" label="Moldova">Moldova</option>
                        
                                        <option value="MC" label="Monaco">Monaco</option>
                        
                                        <option value="ME" label="Montenegro">Montenegro</option>
                        
                                        <option value="NL" label="Netherlands">Netherlands</option>
                        
                                        <option value="NO" label="Norway">Norway</option>
                        
                                        <option value="PL" label="Poland">Poland</option>
                        
                                        <option value="PT" label="Portugal">Portugal</option>
                        
                                        <option value="RO" label="Romania">Romania</option>
                        
                                        <option value="RU" label="Russia">Russia</option>
                        
                                        <option value="SM" label="San Marino">San Marino</option>
                        
                                        <option value="RS" label="Serbia">Serbia</option>
                        
                                        <option value="CS" label="Serbia and Montenegro">Serbia and Montenegro</option>
                        
                                        <option value="SK" label="Slovakia">Slovakia</option>
                        
                                        <option value="SI" label="Slovenia">Slovenia</option>
                        
                                        <option value="ES" label="Spain">Spain</option>
                        
                                        <option value="SJ" label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        
                                        <option value="SE" label="Sweden">Sweden</option>
                        
                                        <option value="CH" label="Switzerland">Switzerland</option>
                        
                                        <option value="UA" label="Ukraine">Ukraine</option>
                        
                                        <option value="SU" label="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                        
                                        <option value="GB" label="United Kingdom">United Kingdom</option>
                        
                                        <option value="VA" label="Vatican City">Vatican City</option>
                        
                                        <option value="AX" label="Åland Islands">Åland Islands</option>
                        
                                        </optgroup>
                        
                                        <optgroup id="country-optgroup-Oceania" label="Oceania">
                        
                                        <option value="AS" label="American Samoa">American Samoa</option>
                        
                                        <option value="AQ" label="Antarctica">Antarctica</option>
                        
                                        <option value="AU" label="Australia">Australia</option>
                        
                                        <option value="BV" label="Bouvet Island">Bouvet Island</option>
                        
                                        <option value="IO" label="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        
                                        <option value="CX" label="Christmas Island">Christmas Island</option>
                        
                                        <option value="CC" label="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>
                        
                                        <option value="CK" label="Cook Islands">Cook Islands</option>
                        
                                        <option value="FJ" label="Fiji">Fiji</option>
                        
                                        <option value="PF" label="French Polynesia">French Polynesia</option>
                        
                                        <option value="TF" label="French Southern Territories">French Southern Territories</option>
                        
                                        <option value="GU" label="Guam">Guam</option>
                        
                                        <option value="HM" label="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                        
                                        <option value="KI" label="Kiribati">Kiribati</option>
                        
                                        <option value="MH" label="Marshall Islands">Marshall Islands</option>
                        
                                        <option value="FM" label="Micronesia">Micronesia</option>
                        
                                        <option value="NR" label="Nauru">Nauru</option>
                        
                                        <option value="NC" label="New Caledonia">New Caledonia</option>
                        
                                        <option value="NZ" label="New Zealand">New Zealand</option>
                        
                                        <option value="NU" label="Niue">Niue</option>
                        
                                        <option value="NF" label="Norfolk Island">Norfolk Island</option>
                        
                                        <option value="MP" label="Northern Mariana Islands">Northern Mariana Islands</option>
                        
                                        <option value="PW" label="Palau">Palau</option>
                        
                                        <option value="PG" label="Papua New Guinea">Papua New Guinea</option>
                        
                                        <option value="PN" label="Pitcairn Islands">Pitcairn Islands</option>
                        
                                        <option value="WS" label="Samoa">Samoa</option>
                        
                                        <option value="SB" label="Solomon Islands">Solomon Islands</option>
                        
                                        <option value="GS" label="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                        
                                        <option value="TK" label="Tokelau">Tokelau</option>
                        
                                        <option value="TO" label="Tonga">Tonga</option>
                        
                                        <option value="TV" label="Tuvalu">Tuvalu</option>
                        
                                        <option value="UM" label="U.S. Minor Outlying Islands">U.S. Minor Outlying Islands</option>
                        
                                        <option value="VU" label="Vanuatu">Vanuatu</option>
                        
                                        <option value="WF" label="Wallis and Futuna">Wallis and Futuna</option>
                        
                                        </optgroup>
                        
                                    </select>
                                    @if ($errors->has('country'))
                                        <span class="help-block">
                                            <strong class="error">{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </fieldset>
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="email" class="label-control">Career Details</label>
                                    <textarea cols="30" rows="15" class="form-control detail2" id="detail1" name="detail1" placeholder="Details about career"></textarea>
                                        @if ($errors->has('detail1'))
                                            <span class="help-block">
                                                <strong class="error">{{ $errors->first('detail1') }}</strong>
                                            </span>
                                        @endif
                                </fieldset>
                                <fieldset class="form-group floating-label-form-group">
                                    <label class="label-control required">Last Date </label>
                                    <input type="date" class="form-control" id="date1" name="date1" placeholder="Date">
                                        @if ($errors->has('date1'))
                                            <span class="help-block">
                                                <strong class="error">{{ $errors->first('date1') }}</strong>
                                            </span>
                                        @endif
                                </fieldset>
                              </div>
                              <div class="modal-footer">
                                  <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="close">
                                  <input type="submit" class="btn btn-outline-primary btn-lg" value="Save">
                              </div>
                            </form>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Import jQuery before export.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>

<!--Data Table-->
<script type="text/javascript"  src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"  src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>

<!--Export table buttons-->
<script type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js" ></script>
<script type="text/javascript"  src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script>
    function confirmDelete(id,name,status) {
        if(status==0){
            var text="inactive";
        }else{
            var text="active";
        }
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to '+text+' the '+name+'?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: `Ok`,
            cancelButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
                $('#'+id).submit();
            } 
        })
    }
     CKEDITOR.replace( 'detail1',{
        filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
    });
    // CKEDITOR.replace( 'detail2' );
    $('.detail2').each(function () {
        CKEDITOR.replace($(this).prop('id'),{
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });
    });
    $('.select2-multi').select2();
    
    $(document).ready(function() {
        $.noConflict();
        $('#DataTables').DataTable({
            "scrollY":'50vh',
            "scrollX": false,
            "paging":true,
            "searching": false,
            "info": false,
            "ordering": false
        });
        });
</script>

@endsection