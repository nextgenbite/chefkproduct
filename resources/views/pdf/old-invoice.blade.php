<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bangla PDF</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" >
    <style>
   /* Global styles */
body {
    font-family: 'my_custom_name', Arial, sans-serif !important;
    /* background: #ccc; */
}

.container {
    width: 21cm;
    min-height: 29.7cm;
}

.invoice {
    background: #fff;
    width: 100%;
    padding: 50px;
}

.logo {
    width: 2.5cm;
}

.document-type {
    text-align: right;
    color: #444;
}

.conditions {
    font-size: 0.7em;
    color: #666;
}

.bottom-page {
    font-size: 0.7em;
}

/* Row and Column styles using float */
.row::after {
    content: "";
    clear: both;
    display: table;
}

.col-7 {
    width: 70%;
    float: left;
}

.col-5 {
    width: 28%;
    float: left;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

.text-right {
    text-align: right;
}

/* Table-striped styles */
.table-striped tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

    </style>
</head>
<body>
    {{-- {!! $paragraphContent !!} --}}
    <div class="container">
        <div class="invoice">
          <div class="row">
            <div class="col-7">
              <img src="https://s3.eu-central-1.amazonaws.com/zl-clients-sharings/90Tech.png" class="logo">
            </div>
            <div class="col-5">
              <h1 class="document-type display-4">FACTURE</h1>
              <p class="text-right"><strong>N°90T-17-01-0123</strong></p>
            </div>
          </div>
          <div class="row">
            <div class="col-7">

              <br><br><br>
              <p>
                <strong>BILL TO</strong><br>

                <p class="text-base font-normal text-gray-500">
                    Bergside Inc., LOUISVILLE, Selby 3864<br> Johnson Street, United
                    States of America <br>VAT Code: AA-1234567890
                </p>
              </p>
            </div>
            <div class="col-5">
              <p>
                <strong>CraftyDwarf LLC</strong><br>
                291 N 4th St, San Jose, CA 95112, USA<br>
                 <div class=" pl-0">
                    <p class="mb-0  mt-2">Order Date : August 1, 2021</p>

                </div>
              </p>
            </div>
          </div>
          <br>
          <br>
          <h6>Audits et rapports mensuels (1er Novembre 2016 - 30 Novembre 2016)</h6>
          <br>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Description</th>
                <th>Quantité</th>
                <th>Unité</th>
                <th>PU HT</th>
                <th>TVA</th>
                <th>Total HT</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Audits et rapports mensuels</td>
                <td>1</td>
                <td>Jour</td>
                <td class="text-right">500,00€</td>
                <td>20%</td>
                <td class="text-right">500,00€</td>
              </tr>
              <tr>
                <td>Génération des rapports d'activité</td>
                <td>4</td>
                <td>Rapport</td>
                <td class="text-right">800,00€</td>
                <td>20%</td>
                <td class="text-right">3 200,00€</td>
              </tr>
            </tbody>
          </table>
          <div class="row">
            <div class="col-8">
            </div>
            <div class="col-4">
              <table class="table table-sm text-right">
                <tr>
                  <td><strong>Total HT</strong></td>
                  <td class="text-right">3 700,00€</td>
                </tr>
                <tr>
                  <td>TVA 20%</td>
                  <td class="text-right">740,00€</td>
                </tr>
                <tr>
                  <td><strong>Total TTC</strong></td>
                  <td class="text-right">4 440,00€</td>
                </tr>
              </table>
            </div>
          </div>

          <p class="conditions">
            En votre aimable règlement
            <br>
            Et avec nos remerciements.
            <br><br>
            Conditions de paiement : paiement à réception de facture, à 15 jours.
            <br>
            Aucun escompte consenti pour règlement anticipé.
            <br>
            Règlement par virement bancaire.
            <br><br>
            En cas de retard de paiement, indemnité forfaitaire pour frais de recouvrement : 40 euros (art. L.4413 et L.4416 code du commerce).
          </p>

          <br>
          <br>
          <br>
          <br>

          <p class="bottom-page text-right">
            90TECH SAS - N° SIRET 80897753200015 RCS METZ<br>
            6B, Rue aux Saussaies des Dames - 57950 MONTIGNY-LES-METZ 03 55 80 42 62 - www.90tech.fr<br>
            Code APE 6201Z - N° TVA Intracom. FR 77 808977532<br>
            IBAN FR76 1470 7034 0031 4211 7882 825 - SWIFT CCBPFRPPMTZ
          </p>
        </div>
      </div>
</body>
</html>
