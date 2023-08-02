<form class="container-xl p-0" id="template" name="template" role="form" action="./../lib/doc_lib.php" method="POST">
    <div id="templatediv" class="card-body border overflow-auto">
        <div id="templatecontent" class="template-body">
            <p></p>
            <p>&nbsp;</p>
            <h2>Agreements&nbsp;</h2>
            <p><strong>I,&nbsp;&nbsp;&nbsp;</strong><span><input class="templateInput" type="text" value="<?php echo $patient['fname']; ?>" style="margin:2px 2px;" data-textvalue="" onblur="templateText(this);"></span>&nbsp;First Name*<strong>&nbsp;&nbsp;&nbsp;</strong><span><input value="<?php echo $patient['lname']; ?>" class="templateInput" type="text" style="margin:2px 2px;" data-textvalue="" onblur="templateText(this);" value="vinu"></span>&nbsp;Last Name*<strong>, authorize Applied Behavioral Sciences, LCSW, PC (ABS)&nbsp;</strong></p>
            <p>To disclose to (Name of Person or Organization to which disclosure is to be made)&nbsp; &nbsp;</p>
            <p><span><textarea class="templateInput" name="authorityName" rows="03" cols="080" style="margin:2px 2px;" data-textvalue="" onblur="templateText(this);"></textarea></span></p>
            <p><strong>Following information: Attendance, Participation, General Progress</strong></p>
            <p><strong>As well as the following information: Name and other personal identifying information, status as a patient, initial evaluation, date of admission, assessment results and history, type of counseling, substance abuse, frequency of use, and duration of use, a summary of the treatment plan, progress, and compliance, attendance, results of a urinalysis and other AOD/toxicology related tests, date of discharge and discharge status, discharge plan, etc.</strong></p>
            <p>&nbsp;</p>
            <p><strong>The purpose of the disclosure authorized in this consent is to:</strong></p>
            <p><strong>To communicate with and disclose to one another the above information for progress reporting and compliance purposes:</strong></p>
            <p>
                <strong>
                    I, understand that my treatment records are protected under federal regulations
                    governing confidentially and The Health Insurance Portability and Accountability Act
                    of 1996 (“HIPPA”), 45 C.F.R. Pts 160 &amp; 164, and cannot be disclosed without my
                    written consent unless otherwise provided for regulations.&nbsp;I also understand that
                    in any event, this consent expires automatically as follows: One year after the last
                    day of service
                </strong><br><br>
                <strong>
                    1.&nbsp;If I am authorizing the release of
                    HIV-related, alcohol or drug treatment, or mental health treatment information,
                    the recipient is prohibited from re-disclosing such information without my
                    authorization unless permitted to do so under federal or state law. I understand
                    that I have the right to request a list of people who may receive or use my
                    HIV-related information without authorization. If I experience discrimination
                    because of the release or disclosure of HIV-related information, I may contact
                    the New York State Division of Human Rights at (212) 480-2493 or the New York City
                    Commission of Human Rights at (212) 306-7450. These agencies are responsible for
                    protecting my rights.
                </strong><br>
                <strong>
                    2.&nbsp;I have the right to revoke this
                    authorization at any time by writing to the program director at ABS. I
                    understand that I may revoke this authorization except to the extent that action
                    has already been taken based on this authorization.
                </strong><br>
                <strong>
                    3.&nbsp;I understand that signing this authorization is voluntary. My treatment,
                    payment, enrollment in a health plan, or eligibility for benefits will not be
                    conditioned upon my authorization of this disclosure.
                </strong><br>
                <strong>
                    4.&nbsp;Information disclosed under this authorization might be redisclosed by
                    the recipient (except as noted above in Item 2), and this redisclosure may no
                    longer be protected by federal or state law.
                </strong><br>
                <strong>
                    5. The authorization does not authorize ABS to discuss my health information or
                    medical care with anyone other than the individual, attorney, law firm or
                    governmental or social service agency, or other organization specified above.&nbsp;
                </strong><br><br>
                <strong>
                    I understand that generally, ABS may not condition my treatment on whether I sign a
                    consent form, In certain limited circumstances I may be denied treatment if I do not
                    sign a consent form.
                </strong><br><br>
                Date:&nbsp; <span><?php echo date('Y-m-d'); ?></span><br><br>
                <?php echo $patient['fname'] . ' ' . $patient['lname']; ?><br>
                Patient Signature&nbsp;&nbsp;
                <script>
                    // page.presentPatientSignature = true;
                </script>
                <span>
                    <!-- <img class="signature" id="patientSignature" style="cursor:pointer;color:red;height:65px !important;width:auto;" data-type="patient-signature" data-action="fetch_signature" alt="Click in signature" data-pid="88" data-user="-patient-" src="data:image/svg+xml,%3C%3Fxml version='1.0' standalone='no'%3F%3E%3C!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 20010904//EN' 'http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd'%3E%3Csvg version='1.0' xmlns='http://www.w3.org/2000/svg' width='852.000000pt' height='265.000000pt' viewBox='0 0 852.000000 265.000000' preserveAspectRatio='xMidYMid meet'%3E%3Cg transform='translate(0.000000,265.000000) scale(0.100000,-0.100000)'%0Afill='%23000000' stroke='none'%3E%3Cpath d='M390 1534 c-19 -14 -67 -57 -107 -96 l-71 -71 -31 34 c-16 19 -38 49%0A-48 67 -18 32 -53 44 -53 18 0 -17 47 -111 72 -144 17 -23 17 -25 -21 -75 -46%0A-62 -85 -143 -77 -163 3 -8 14 -14 25 -14 15 0 27 15 45 53 23 52 71 117 85%0A117 4 0 15 -15 25 -32 11 -18 34 -50 52 -70 18 -20 40 -51 49 -67 9 -19 23%0A-31 35 -31 38 0 18 71 -34 119 -33 31 -89 117 -84 130 1 6 49 57 106 115 56%0A57 102 111 102 120 0 23 -29 18 -70 -10z'/%3E%3C/g%3E%3C/svg%3E"> -->
                </span>
            </p>
            <p>Guardian Signature&nbsp;&nbsp;&nbsp;&nbsp;
                <script>
                    // page.presentWitnessSignature = true;
                </script>
                <span>
                    <!-- <img class="signature" id="witnessSignature" style="cursor:pointer;color:red;height:65px !important;width:auto;" data-type="witness-signature" data-action="fetch_signature" alt="Click in signature" data-pid="88" data-user="0" src="data:image/svg+xml,%3C%3Fxml version='1.0' standalone='no'%3F%3E%3C!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 20010904//EN' 'http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd'%3E%3Csvg version='1.0' xmlns='http://www.w3.org/2000/svg' width='852.000000pt' height='265.000000pt' viewBox='0 0 852.000000 265.000000' preserveAspectRatio='xMidYMid meet'%3E%3Cg transform='translate(0.000000,265.000000) scale(0.100000,-0.100000)'%0Afill='%23000000' stroke='none'%3E%3Cpath d='M390 1534 c-19 -14 -67 -57 -107 -96 l-71 -71 -31 34 c-16 19 -38 49%0A-48 67 -18 32 -53 44 -53 18 0 -17 47 -111 72 -144 17 -23 17 -25 -21 -75 -46%0A-62 -85 -143 -77 -163 3 -8 14 -14 25 -14 15 0 27 15 45 53 23 52 71 117 85%0A117 4 0 15 -15 25 -32 11 -18 34 -50 52 -70 18 -20 40 -51 49 -67 9 -19 23%0A-31 35 -31 38 0 18 71 -34 119 -33 31 -89 117 -84 130 1 6 49 57 106 115 56%0A57 102 111 102 120 0 23 -29 18 -70 -10z'/%3E%3C/g%3E%3C/svg%3E"> -->
                </span>&nbsp;
            </p>
            <p>&nbsp;</p>
        </div>
    </div>
    <input type="hidden" name="csrf_token_form" id="csrf_token_form" value="76c076f2f84ccd3f92d2db613113a750afcdaa4a">
    <input type="hidden" name="content" id="content" value="">
    <input type="hidden" name="cpid" id="cpid" value="">
    <input type="hidden" name="docid" id="docid" value="Informed consent for the release of information">
    <input type="hidden" name="template_id" id="template_id" value="">
    <input type="hidden" name="handler" id="handler" value="download">
    <input type="hidden" name="status" id="status" value="Open">
</form>