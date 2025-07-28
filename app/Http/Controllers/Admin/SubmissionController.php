<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use Carbon\Carbon; 


class SubmissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Submission::query();

        $query->where('status', 'pending');

        if ($request->filled('search')) {
            $query->where('vendor', 'like', '%' . $request->search . '%');
        }
        $submissions = $query->orderBy('id', 'desc')->get();

        return view('admin.submission.index', compact('submissions'));
    }

    public function approved(Request $request)
    {
        $query = Submission::query()->where('status', 'approved');

        if ($request->filled('search')) {
            $query->where('vendor', 'like', '%' . $request->search . '%');
        }

        $submissions = $query->orderBy('id', 'desc')->get();

        return view('admin.submission.approved', compact('submissions'));
    }

    public function rejected(Request $request)
    {
        $query = Submission::query()
            ->where('status', 'rejected'); // Tetap filter status

        // Tambah filter vendor kalau ada pencarian
        if ($request->filled('search')) {
            $query->where('vendor', 'like', '%' . $request->search . '%');
        }

        $submissions = $query->orderBy('id', 'desc')->get();

        return view('admin.submission.rejected', compact('submissions'));
    }


    public function create()
    {
        return view('admin.submission.create');
    }
    
    public function store(Request $request)
    {
        try {
         $data = $request->validate([
        'vendor' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'name_event' => 'required|string|max:255',
        'file' => 'file|mimes:pdf',
        'ktp' => 'required|file|mimes:pdf',
        'appl_letter' => 'file|mimes:pdf',
        'actv_letter' => 'file|mimes:pdf',
        ]);

        $data['status'] = 'pending';

        $data['apply_date'] = Carbon::now()->format('Y-m-d H:i');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('assets/rundowns', 'public');
            $data['file'] = $filePath;
        }
        if ($request->hasFile('ktp')) {
            $ktpFile = $request->file('ktp');
            $ktpPath = $ktpFile->store('assets/ktp', 'public');
            $data['ktp'] = $ktpPath;
        }
        if ($request->hasFile('appl_letter')) {
            $applLetterFile = $request->file('appl_letter');
            $applLetterPath = $applLetterFile->store('assets/appl_letters', 'public');
            $data['appl_letter'] = $applLetterPath;
        }
        if ($request->hasFile('actv_letter')) {
            $actvLetterFile = $request->file('actv_letter');
            $actvLetterPath = $actvLetterFile->store('assets/actv_letters', 'public');
            $data['actv_letter'] = $actvLetterPath;
        }
        Submission::create($data);

        return redirect()->route('submission.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
        return back()
            ->withInput()
            ->with('error', 'Terjadi kesalahan saat mengubah konten: ' . $e->getMessage());
        }
    }

    public function approve($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->update(['status' => 'approved']);
        $submission->save();

        return back()->with('success', 'Pengajuan disetujui.');
    }

    public function reject($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->update(['status' => 'rejected']);
        $submission->save();

        return back()->with('success', 'Pengajuan ditolak.');
    }

}
