<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Submission;
use App\Models\Activity;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data event
        $eventQuery = Event::query();
        if ($request->filled('search')) {
            $eventQuery->where('vendor', 'like', '%' . $request->search . '%');
        }
        $events = $eventQuery->get()->map(function ($event) {
            $event->type = 'event'; // tambahkan tipe untuk identifikasi
            return $event;
        });
        // Ambil data submission
        $submissionQuery = Submission::query();
        $submissionQuery->where('status', 'approved'); // hanya ambil yang pending
        if ($request->filled('search')) {
            $submissionQuery->where('vendor', 'like', '%' . $request->search . '%');
        }
        $submissions = $submissionQuery->get()->map(function ($sub) {
            $sub->type = 'submission'; // tambahkan tipe untuk identifikasi
            return $sub;
        });

        $combined = $events->concat($submissions)->sortByDesc('id');

        return view('admin.event.index', [
            'combined' => $combined
        ]);
    }

    public function create()
    {
        return view('admin.event.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vendor' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'name_event' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Cek bentrok event
        $conflict = Event::where(function ($query) use ($data) {
            $query->where('start_date', '<=', $data['end_date'])
                ->where('end_date', '>=', $data['start_date']);
        })->first();

        if ($conflict) {
        return redirect()->back()
            ->with('error', 'Tanggal yang dipilih bentrok dengan event lain: ' .
                $conflict->name_event . ' oleh ' . $conflict->vendor .
                ' (' . $conflict->start_date . ' s/d ' . $conflict->end_date . ')')
            ->withInput($request->except(['start_date', 'end_date']));
        }

        if ($request->hasFile('rundown')) {
            $file = $request->file('rundown');
            $rundownPath = $file->store('assets/rundowns', 'public'); // simpan ke storage/app/public/rundowns
            $data['file'] = $rundownPath;
        }

        Event::create($data);

        Activity::create([
            'admin_id' => auth('admin')->id(),
            'description' => 'menambahkan jadwal event baru.',
        ]);
        
        return redirect()->route('event.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'vendor' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'name_event' => 'required|string|max:255',
        ]);

        // Cek bentrok event
        $conflict = Event::where('id', '!=', $event->id) // abaikan event saat ini
            ->where(function ($query) use ($data) {
                $query->where('start_date', '<=', $data['end_date'])
                    ->where('end_date', '>=', $data['start_date']);
            })->first();

        if ($conflict) {
        return redirect()->back()
            ->with('error', 'Tanggal yang dipilih bentrok dengan event lain: ' .
                $conflict->name_event . ' oleh ' . $conflict->vendor .
                ' (' . $conflict->start_date . ' s/d ' . $conflict->end_date . ')')
            ->withInput($request->except(['start_date', 'end_date']));
        }

        // Jika ada file baru diupload
        if ($request->hasFile('rundown')) {
        // Hapus file lama jika ada
        if ($event->file && Storage::disk('public')->exists($event->file)) {
            Storage::disk('public')->delete($event->file);
        }

        // Simpan file baru
        $file = $request->file('rundown');
        $path = $file->store('assets/rundowns', 'public');
        $data['file'] = $path;
        } else {
            // Jika tidak ada file baru, tetap gunakan file lama
            $data['file'] = $event->file;
        }

        // Update jika tidak bentrok
        $event->update($data);

        Activity::create([
            'admin_id' => auth('admin')->id(),
            'description' => 'mengedit jadwal event.',
        ]);

        return redirect()->route('event.index')->with('success', 'Data berhasil diperbarui.');
    }

    
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('event.index')->with('success', 'Data berhasil dihapus.');
    }
}
