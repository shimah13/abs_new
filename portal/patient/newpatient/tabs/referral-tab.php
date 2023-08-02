
<div class="row" style="margin-bottom: 1rem;">
    <label>
        <h2>Client Information</h2></br>
        This information is held in strict confidence and is protected under federal HIPAA laws and will be used only for clinical purposes. Please complete it as accurately and as detailed as possible. If you have any questions please call our office at 1800-574-9ABS and speak to an on-call administrator. Thank you
    </label>
</div>

<div class="row">
    <label>What is your ethnicity? <span style="color:red">*</span> : </label>
    <?= generateRadioButtons('Ethnicity', 'ethnicity') ?>
</div>

<div class="row"><label>What is your religion? <span style="color:red">*</span> : </label>
    <?= generateRadioButtons('Religion', 'religion') ?>
</div>

<!--<div class="row">
    <label>Please provide your best phone number :<span style="color:red">*</span></label><br>
    <input type="text" class="form-control" name="ph_no1" required style="width:50%">
</div>
<div class="row">
    <label>Phone Number 2 : </label><br>
    <input type="text" class="form-control" name="ph_no2" style="width:50%">
</div>
<div class="row">
    <label>Address <span style="color:red">*</span></label>
    <input type="text" class="form-control" name="adr1" placeholder="Address1" required style="width:50%"></br>
    <input type="text" class="form-control" name="Adr2" placeholder="Address2" style="width:50%"></br>
    <input type="text" class="form-control" name="city" placeholder="City" style="width:50%"></br>
    <input type="text" class="form-control" name="state" placeholder="State" style="width:50%"></br>
    <input type="text" class="form-control" name="zip" placeholder="Zip/Postal code" style="width:50%">
</div>
-->
<div class="row"><label>What type of living environment do you reside in?</label>
    <?= generateDropdown('living_environment', 'living_environment') ?>
</div>

<div class="row" name="aptnumber" style="display:none">
    <label>What is your apartment number?<span style="color:red">*</span></label>
    <input type="text" name="apt_number" class="form-control" style="width:50%">
</div>

<div class="row" name="quaHouse" style="display:none">
    <label>Name of three quarter house or program<span style="color:red">*</span></label>
    <input type="text" name="qua_house" class="form-control" style="width:50%">
</div>

<div class="row" name="halfHouse" style="display:none">
    <label>Name of halfway house or program<span style="color:red">*</span></label>
    <input type="text" name="half_house" class="form-control" style="width:50%">
</div>

<div class="row" name="residentTreatmentPgm" style="display:none">
    <label>Name of Residential Treatment Program ?<span style="color:red">*</span></label>
    <input type="text" name="resident_treat_pgm" class="form-control" style="width:50%">
</div>

<div class="row" name="shelterName" style="display:none">
    <label>Name of Shelter<span style="color:red">*</span></label>
    <input type="text" name="shelter_name" class="form-control" style="width:50%">
</div>

<div class="row">
    <span style="color:red">
        <h4>Payment Information</h4>
    </span>
</div>
<div class="row">
    <label>How do you intend to pay for your therapy?<span style="color:red">*</span></label><br>
    <?= generateRadioButtons('payment_info', 'payment_ifo') ?>
</div>
<div class="row" name="insuranceComDiv" style="display:none">
    <label>Insurance Company</label><br><select name="insurance_comapny" class="form-control" style="width:50%;">
        <option value="">--Select Insurance Company--</option>
        <?php
        $getComapnies = sqlStatement("select id, name from insurance_companies");
        while ($row = sqlFetchArray($getComapnies)) { ?>
            <option value="<?= $row['id'] ?>"> <?= $row['name'] ?></option>
        <?php } ?>
    </select><br>
    <label>insuranceID</label><br>
    <input type="text" class="form-control" style="width:50%" name="insuranceID">
</div>

<div class="row" name="eapDiv" style="display: none;">
    <label>Name of the EAP program <span style="color: red;"> * </span></label>
    <?= generateRadioButtons('eap_pgms_rad', 'eap_pgms') ?>

    <label>Name of the EAP program <span style="color:red;"> * </span></label>
    <?php
    $getEthnicity = sqlStatement("select * from list_options where list_id = ? and activity = 1 order by seq asc", ["eap_pgms"]);
    while ($row = sqlFetchArray($getEthnicity)) { ?>
        <label><?= $row['title'] ?></label>
        <input type="text" name="<?= $row['option_id'] ?>" style="width:50%" class="form-control"></br>
    <?php } ?>
</div>

<div class="row">
    <label>
        Who Referred You to ABS? Please include all involved agencies with all contact
        information, including phone numbers and emails. If you where referred by a court
        please also include attorney information. If you have more then one case please let
        us know now to help you.
    </label>
    <?= generateCheckBox('refsource', 'Who_Referred_You_to_ABS_') ?>
</div>

<!-- Lawyer div -->
<div class="row" name="lawyerDiv" style="display:none">
    <label>Who represents you? <span style="color:red">*</span></label>
    <?= generateRadioButtons('lawyerDiv', 'lawyerDiv_info') ?>

    <label>What type of case is this <span style="color:red">*</span></label>
    <?= generateRadioButtons('caseType', 'caseType_info') ?>

    <label>Attorney's Name</label><span style="color:red">*</span></br>
    <input type="text" name="lawyer_attroney_name" class="form-control" style="width:50%"></br>

    <label>Attorney's Phone Number</label><span style="color:red">*</span></br>
    <input type="text" name="lawyer_attroney_phone" class="form-control" style="width:50%"></br>

    <label>Attorney's Email</label><span style="color:red">*</span></br>
    <input type="text" name="lawyer_attroney_email" class="form-control" style="width:50%"></br>
</div>

<!-- Childwelfare div -->
<div class="row" name="childwelfareDiv" style="display:none">
    <label>Which Child Welfare Office?<span style="color:red">*</span></label>
    <?= generateRadioButtons('child_welfare', 'childwelfare') ?>

    <label>Child Welfare Worker's Name<span style="color:red">*</span></label>
    <input type="text" name="welfare_worker_name" class="form-control" style="width:50%"></br>

    <label>Child Welfare Worker's Phone Number<span style="color:red">*</span></label>
    <input type "text" name="welfare_worker_ph" class="form-control" style="width:50%"></br>

    <label>Child Welfare Worker's Email<span style="color:red">*</span></label>
    <input type="text" name="welfare_worker_email" class="form-control" style="width:50%"></br>
</div>

<!-- Court -->
<div class="row" name="courtDiv" style="display:none">
    <label>
        Where is your court case? <span style="color:red">*</span>
    </label>
    <?= generateRadioButtons('Intake_courts', 'countyName') ?>
    <div class="radio">
        <label>
            <input type="radio" name="countyName" value="Other"> Other
        </label>
    </div>

    <?php
    $county_courts = [
        'Kingscounty' => 'Intake_kings_court',
        'richmondcount' => 'Intake_richmond_court',
        'newyorkcounty' => 'Intake_newyork_court',
        'Queens County' => 'Intake_Queens_Court',
        'Bronx County' => 'Intak_Bronx_Court',
        'Nassau County' => 'Intake_Nassau_Court',
        'Suffolk County' => 'Intake_Suffolk_County_Court',
        'Westchester County' => 'westchester_court_list',
        'Rockland County' => 'Intake_Rockland_County_Court',
        'Hudson County' => 'Intake_Hudson_County_Court',
        'Essex County' => 'Intak_Essex_County_Court',
        'Bergen County' => 'Intake_Bergen_County_Court',
        'Union County' => 'Intake_Union_Courts',
    ];
    ?>

    <?php foreach ($county_courts as $county => $court) { ?>
        <div class="county_courts" name="<?= $county ?>" style="display: none;">
            <label>Select your county court</label>
            <?= generateRadioButtons($court, 'courtName') ?>
            <div class="radio">
                <label>
                    <input type="radio" name="courtName" value="Other"> Other
                </label>
                <input type="text" style="width: 100px" name="otherCourtName">
            </div>
        </div>
    <?php } ?>

    <div class="county_courts" name="Other" style="display:none">
        <label>Enter the exact name of the referring court: </label>
        <input type="text" style="width: 100px" name="courtName">
    </div>

</div>

<!-- DMV -->
<div class="row" name="DMVDiv" style="display:none">
    <label>Which DMV?</label>
    <?= generateRadioButtons('dmv', 'dmv') ?>
</div>

<!-- Probation -->
<div class="row" name="probationDiv" style="display:none">
    <label>Which department of Probation referred you?<span style="color:red">*</span></label>
    <?= generateRadioButtons('Intake_Probation', 'prob_courtCase') ?>

    <label>Probation Officer's Name<span style="color:red">*</span></label>
    <input type="text" name="prob_offc_name" class="form-control" style="width:50%"></br>

    <label>Probation Officer's Phone Number<span style="color:red">*</span></label>
    <input type="text" name="prob_offc_ph" class="form-control" style="width:50%"></br>

    <label>Probation Officer's Email<span style="color:red">*</span></label>
    <input type="text" name="prob_offc_email" class="form-control" style="width:50%"></br>
</div>

<div class="row" name="doctorDiv" style="display:none">
    <label>Doctor's Name<span style="color:red">*</span></label>
    <input type="text" name="doc_name" class="form-control" style="width:50%"></br>

    <label>Doctor's Phone Number<span style="color:red">*</span></label>
    <input type="text" name="doc_phone" class="form-control" style="width:50%"></br>

    <label>Doctor's Email<span style="color:red">*</span></label>
    <input type="text" name="doc_email" class="form-control" style="width:50%"></br>
</div>

<div class="row" name="hospitalDiv" style="display:none">
    <label>What is the name of the Hospital<span style="color:red">*</span></label>
    <input type="text" name="hospital_name" class="form-control" style="width:50%"></br>
</div>

<div class="row" name="paroleDiv" style="display:none">
    <label>Parole Officer's Name<span style="color:red">*</span></label>
    <input type="text" name="parole_offc_name" class="form-control" style="width:50%"></br>

    <label>Parole Officer's Phone Number<span style="color:red">*</span></label>
    <input type="text" name="parole_offc_ph" class="form-control" style="width:50%"></br>


    <label>Parole Officer's Email<span style="color:red">*</span></label>
    <input type="text" name="parole_offc_email" class="form-control" style="width:50%"></br>
</div>

<div class="row" name="socialWorkerDiv" style="display:none">
    <label>Social Worker's Name<span style="color:red">*</span></label>
    <input type="text" name="social_worker_name" class="form-control" style="width:50%"></br>

    <label>Social Worker's Phone Number<span style="color:red">*</span></label>
    <input type="text" name="social_worker_ph" class="form-control" style="width:50%"></br>

    <label>Social Worker's Email<span style="color:red">*</span></label>
    <input type="text" name="social_worker_email" class="form-control" style="width:50%"></br>
</div>
