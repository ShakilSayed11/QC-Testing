<?php
require_once('tcpdf/tcpdf.php');

// Initialize PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Add a page
$pdf->AddPage();

// Example content, replace with your own
$html = '<h1>Quality and Error Checks for Credibility Interviewers</h1>';
$html .= '<table border="1">';
$html .= '<tr><th>Sr. No.</th><th>Task Timings</th><th>Description</th><th>QC Remarks</th><th>QC Comments</th><th>Score (0-10)</th></tr>';

// Loop through submitted form data
for ($i = 0; $i < count($_POST['score']); $i++) {
  $srNo = $i + 1;
  $taskTimings = $_POST['taskTimings'.$i]; // Adjust field names accordingly
  $description = $_POST['description'.$i];
  $qcRemarks = $_POST['qcRemarks'.$i];
  $qcComments = $_POST['qcComments'.$i];
  $score = $_POST['score'.$i];

  // Add row to PDF
  $html .= "<tr><td>$srNo</td><td>$taskTimings</td><td>$description</td><td>$qcRemarks</td><td>$qcComments</td><td>$score</td></tr>";
}

$html .= '</table>';

// Output PDF
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('quality_checks.pdf', 'D');
?>
