<?php

class LeadsController extends Controller
{
    public function leadIndex()
    {
        $paginationResult = $this->model('LeadModel')->findAll([
            'pagination' => ['enabled' => true, 'page' => $_GET['page'] ?? 1, 'perPage' => 5],
        ]);
    
        $leads = $paginationResult['data'];   // leads data
        $meta = $paginationResult['meta'];    // pagination info
    
        return $this->adminView('leads/leadsAll', [
            'leads' => $leads,
            'pagination' => $meta,
        ]);
    }
    

    public function leadCreate()
    {
        return $this->adminView('leads/leadsNew');
    }

    public function leadStore(Request $request)
    {
        $data = $request->getBody();
        $leadModel = $this->model('LeadModel');

        $inserted = $leadModel->create([
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'serviceInterested' => $data['serviceInterested'] ?? null,
            'status' => $data['status'] ?? 'new',
        ]);

        if ($inserted) {
            redirect('admin/leads');
        } else {
            echo "Failed to insert lead!";
        }
    }

    public function leadShow($leadId)
    {
        $lead = $this->model('LeadModel')->find($leadId);

        if (!$lead) {
            echo "Lead not found!";
            return;
        }

        return $this->adminView('leads/leadsSingle', ['lead' => $lead]);
    }

    public function leadEdit($leadId)
    {
        $lead = $this->model('LeadModel')->find($leadId);

        if (!$lead) {
            echo "Lead not found!";
            return;
        }

        return $this->adminView('leads/leadsEdit', ['lead' => $lead]);
    }

    public function leadUpdate(Request $request, $leadId)
    {
        $data = $request->getBody();
        $leadModel = $this->model('LeadModel');

        $updated = $leadModel->update([
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'serviceInterested' => $data['serviceInterested'] ?? null,
            'status' => $data['status'] ?? 'new',
        ], $leadId);

        if ($updated) {
            redirect('admin/leads');
        } else {
            echo "Failed to update lead!";
        }
    }

    public function leadDestroy($leadId)
    {
        $leadModel = $this->model('LeadModel');
        $deleted = $leadModel->delete($leadId);

        if ($deleted) {
            redirect('admin/leads');
        } else {
            echo "Failed to delete lead!";
        }
    }

    public function leadExportCsv()
    {
       // echo "Exporting leads..."; exit;
        $leads = $this->model('LeadModel')->findAll()->get();
    
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="leads.csv"');
    
        $output = fopen('php://output', 'w');
    
        if (!empty($leads)) {
            // Write CSV header
            fputcsv($output, array_keys($leads[0]->toArray()));
    
            // Write each lead row
            foreach ($leads as $lead) {
                fputcsv($output, array_values($lead->toArray()));
            }
        }
    
        fclose($output);
        exit;
    }
    
}
