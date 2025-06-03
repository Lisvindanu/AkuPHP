<?php
session_start();

if (!isset($_SESSION["submit"]) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// Simple PDF class (manual implementation to avoid external dependencies)
class SimplePDF {
    private $content = '';
    private $pageWidth = 595.28; // A4 width in points
    private $pageHeight = 841.89; // A4 height in points
    private $margin = 50;
    
    public function __construct() {
        $this->content = "%PDF-1.4\n";
    }
    
    public function addText($x, $y, $text, $size = 12) {
        // Simple text addition (basic implementation)
        $this->content .= "BT\n/{$size} Tf\n{$x} {$y} Td\n({$text}) Tj\nET\n";
    }
    
    public function output($filename = 'report.pdf') {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        // Create simple HTML to PDF conversion
        $this->generateHTMLToPDF();
    }
    
    private function generateHTMLToPDF() {
        // Since we can't use external libraries, we'll generate an HTML report
        // that can be printed to PDF by the browser
        header('Content-Type: text/html');
        echo $this->getHTMLReport();
    }
    
    public function getHTMLReport() {
        global $conn;
        
        $services = query("SELECT * FROM services ORDER BY created_at DESC");
        $projects = query("SELECT p.*, s.title as service_title FROM projects p 
                          LEFT JOIN services s ON p.service_id = s.id 
                          ORDER BY p.created_at DESC");
        $testimonials = query("SELECT t.*, p.title as project_title FROM testimonials t 
                              LEFT JOIN projects p ON t.project_id = p.id 
                              ORDER BY t.created_at DESC");
        $messages = query("SELECT cm.*, s.title as service_title FROM contact_messages cm 
                          LEFT JOIN services s ON cm.service_interest = s.id 
                          ORDER BY cm.created_at DESC");
        
        $totalServices = count($services);
        $totalProjects = count($projects);
        $totalTestimonials = count($testimonials);
        $totalMessages = count($messages);
        $completedProjects = count(query("SELECT * FROM projects WHERE status = 'completed'"));
        $activeServices = count(query("SELECT * FROM services WHERE status = 'active'"));
        
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Anaphygon Retro - Business Report</title>
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    margin: 20px;
                    font-size: 12px;
                }
                .header { 
                    text-align: center; 
                    border-bottom: 2px solid #FF6B35; 
                    padding-bottom: 20px; 
                    margin-bottom: 30px;
                }
                .logo { 
                    font-size: 24px; 
                    font-weight: bold; 
                    color: #FF6B35; 
                }
                .stats { 
                    display: flex; 
                    justify-content: space-around; 
                    margin-bottom: 30px;
                    border: 1px solid #ddd;
                    padding: 15px;
                }
                .stat-item { 
                    text-align: center; 
                }
                .stat-number { 
                    font-size: 20px; 
                    font-weight: bold; 
                    color: #2C3E50; 
                }
                .stat-label { 
                    color: #666; 
                    font-size: 11px;
                }
                table { 
                    width: 100%; 
                    border-collapse: collapse; 
                    margin-bottom: 25px;
                }
                th, td { 
                    border: 1px solid #ddd; 
                    padding: 8px; 
                    text-align: left;
                }
                th { 
                    background-color: #2C3E50; 
                    color: white; 
                    font-weight: bold;
                }
                .section-title { 
                    color: #FF6B35; 
                    font-size: 16px; 
                    font-weight: bold; 
                    margin: 25px 0 15px 0;
                    border-bottom: 1px solid #FF6B35;
                    padding-bottom: 5px;
                }
                .badge { 
                    padding: 3px 8px; 
                    border-radius: 3px; 
                    font-size: 10px; 
                    font-weight: bold;
                }
                .badge-success { background: #28a745; color: white; }
                .badge-warning { background: #ffc107; color: black; }
                .badge-info { background: #17a2b8; color: white; }
                .badge-secondary { background: #6c757d; color: white; }
                .footer { 
                    text-align: center; 
                    margin-top: 40px; 
                    padding-top: 20px; 
                    border-top: 1px solid #ddd; 
                    color: #666;
                    font-size: 11px;
                }
                @media print {
                    body { margin: 0; }
                    .no-print { display: none; }
                }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="logo">ANAPHYGON RETRO</div>
                <div>Creative Design Studio - Business Report</div>
                <div style="font-size: 11px; color: #666; margin-top: 10px;">
                    Generated on: ' . date('d F Y, H:i:s') . '
                </div>
            </div>
            
            <div class="stats">
                <div class="stat-item">
                    <div class="stat-number">' . $totalServices . '</div>
                    <div class="stat-label">Total Services</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">' . $activeServices . '</div>
                    <div class="stat-label">Active Services</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">' . $totalProjects . '</div>
                    <div class="stat-label">Total Projects</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">' . $completedProjects . '</div>
                    <div class="stat-label">Completed Projects</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">' . $totalTestimonials . '</div>
                    <div class="stat-label">Testimonials</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">' . $totalMessages . '</div>
                    <div class="stat-label">Messages</div>
                </div>
            </div>
            
            <div class="section-title">Services Overview</div>
            <table>
                <thead>
                    <tr>
                        <th>Service Name</th>
                        <th>Price Range</th>
                        <th>Status</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>';
                
        foreach ($services as $service) {
            $statusClass = $service['status'] == 'active' ? 'badge-success' : 'badge-secondary';
            $html .= '
                    <tr>
                        <td>' . $service['title'] . '</td>
                        <td>' . $service['price_range'] . '</td>
                        <td><span class="badge ' . $statusClass . '">' . ucfirst($service['status']) . '</span></td>
                        <td>' . date('d/m/Y', strtotime($service['created_at'])) . '</td>
                    </tr>';
        }
        
        $html .= '
                </tbody>
            </table>
            
            <div class="section-title">Projects Overview</div>
            <table>
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Client</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Completion Date</th>
                    </tr>
                </thead>
                <tbody>';
                
        foreach ($projects as $project) {
            $statusClasses = [
                'completed' => 'badge-success',
                'in_progress' => 'badge-warning',
                'planning' => 'badge-info'
            ];
            $statusClass = $statusClasses[$project['status']] ?? 'badge-secondary';
            
            $html .= '
                    <tr>
                        <td>' . $project['title'] . '</td>
                        <td>' . $project['client_name'] . '</td>
                        <td>' . $project['service_title'] . '</td>
                        <td><span class="badge ' . $statusClass . '">' . ucfirst(str_replace('_', ' ', $project['status'])) . '</span></td>
                        <td>' . ($project['completion_date'] ? date('d/m/Y', strtotime($project['completion_date'])) : 'TBD') . '</td>
                    </tr>';
        }
        
        $html .= '
                </tbody>
            </table>
            
            <div class="section-title">Client Testimonials Summary</div>
            <table>
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Company</th>
                        <th>Project</th>
                        <th>Rating</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>';
                
        foreach ($testimonials as $testimonial) {
            $stars = str_repeat('★', $testimonial['rating']) . str_repeat('☆', 5 - $testimonial['rating']);
            $html .= '
                    <tr>
                        <td>' . $testimonial['client_name'] . '</td>
                        <td>' . $testimonial['client_company'] . '</td>
                        <td>' . $testimonial['project_title'] . '</td>
                        <td>' . $stars . ' (' . $testimonial['rating'] . '/5)</td>
                        <td>' . date('d/m/Y', strtotime($testimonial['created_at'])) . '</td>
                    </tr>';
        }
        
        $html .= '
                </tbody>
            </table>
            
            <div class="section-title">Contact Messages Summary</div>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Service Interest</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>';
                
        foreach (array_slice($messages, 0, 20) as $message) { // Limit to latest 20 messages
            $statusClasses = [
                'new' => 'badge-warning',
                'read' => 'badge-info',
                'replied' => 'badge-success',
                'archived' => 'badge-secondary'
            ];
            $statusClass = $statusClasses[$message['status']] ?? 'badge-secondary';
            
            $html .= '
                    <tr>
                        <td>' . date('d/m/Y', strtotime($message['created_at'])) . '</td>
                        <td>' . $message['name'] . '</td>
                        <td>' . substr($message['subject'], 0, 30) . (strlen($message['subject']) > 30 ? '...' : '') . '</td>
                        <td>' . ($message['service_title'] ?? 'General') . '</td>
                        <td><span class="badge ' . $statusClass . '">' . ucfirst($message['status']) . '</span></td>
                    </tr>';
        }
        
        $html .= '
                </tbody>
            </table>
            
            <div class="footer">
                <div><strong>Anaphygon Retro</strong> - Creative Design Studio</div>
                <div>Bandung, West Java, Indonesia | hello@anaphygonretro.com</div>
                <div>This report contains confidential business information</div>
            </div>
            
            <script>
                // Auto print when page loads (for PDF generation)
                window.onload = function() {
                    if (confirm("Do you want to print/save this report as PDF?")) {
                        window.print();
                    }
                }
            </script>
        </body>
        </html>';
        
        return $html;
    }
}

// Generate PDF Report
if (isset($_GET['generate'])) {
    $pdf = new SimplePDF();
    $pdf->output('anaphygon_retro_report_' . date('Y-m-d') . '.pdf');
    exit;
}

// If not generating, show the HTML version
$pdf = new SimplePDF();
echo $pdf->getHTMLReport();
?>