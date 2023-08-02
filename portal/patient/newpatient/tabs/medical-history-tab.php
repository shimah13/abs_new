<form class="container-xl p-0" id="template" name="template" role="form" action="./../lib/doc_lib.php" method="POST">
    <div id="templatediv" class="card-body border overflow-auto">
        <div id="templatecontent" class="template-body">
            <script>
                // page.isFrameForm = 1;
                // page.encounterFormName = "HIS"
            </script>
            <iframe id="encounterForm" class="lbfFrame" style="height:100vh;width:100%;border:0;" src="/interface/forms/LBF/new.php?isPortal=1&amp;formOrigin=0&amp;formname=HIS&amp;id=0"></iframe>
            <br><br>Patient Signature:
            <script>
                // page.presentPatientSignature = true;
            </script>
            <span>
                <!-- <img class="signature" id="patientSignature" style="cursor:pointer;color:red;height:65px !important;width:auto;" data-type="patient-signature" data-action="fetch_signature" alt="Click in signature" data-pid="88" data-user="-patient-" src="data:image/svg+xml,%3C%3Fxml version='1.0' standalone='no'%3F%3E%3C!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 20010904//EN' 'http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd'%3E%3Csvg version='1.0' xmlns='http://www.w3.org/2000/svg' width='852.000000pt' height='265.000000pt' viewBox='0 0 852.000000 265.000000' preserveAspectRatio='xMidYMid meet'%3E%3Cg transform='translate(0.000000,265.000000) scale(0.100000,-0.100000)'%0Afill='%23000000' stroke='none'%3E%3Cpath d='M390 1534 c-19 -14 -67 -57 -107 -96 l-71 -71 -31 34 c-16 19 -38 49%0A-48 67 -18 32 -53 44 -53 18 0 -17 47 -111 72 -144 17 -23 17 -25 -21 -75 -46%0A-62 -85 -143 -77 -163 3 -8 14 -14 25 -14 15 0 27 15 45 53 23 52 71 117 85%0A117 4 0 15 -15 25 -32 11 -18 34 -50 52 -70 18 -20 40 -51 49 -67 9 -19 23%0A-31 35 -31 38 0 18 71 -34 119 -33 31 -89 117 -84 130 1 6 49 57 106 115 56%0A57 102 111 102 120 0 23 -29 18 -70 -10z'/%3E%3C/g%3E%3C/svg%3E"> -->
            </span><br>
        </div>
    </div>
    <input type="hidden" name="csrf_token_form" id="csrf_token_form" value="e81f4710111a71ca4f518e1d3820871f89d3c8fe">
    <input type="hidden" name="content" id="content" value="">
    <input type="hidden" name="cpid" id="cpid" value="">
    <input type="hidden" name="docid" id="docid" value="Medical History">
    <input type="hidden" name="template_id" id="template_id" value="">
    <input type="hidden" name="handler" id="handler" value="download">
    <input type="hidden" name="status" id="status" value="Open">
</form>