<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    private function getUserButtons(User $user) {
        $id = $user->id;

        $buttonShow =
            '<a href="'.route('business.patient.show', $id).'" title="view" id="show-'.$id.'" class="grow flex justify-center items-center py-1 border-[2px] border-green-500/80 rounded-md hover:bg-green-500/80 group">
                <i class="fa-regular fa-eye text-green-500 group-hover:text-white"></i>
            </a>';

        $buttonEdit =
            '<a href="'.route('business.patient.edit', $id).'" title="update" id="edit-'.$id.'" class="grow flex justify-center items-center py-1 border-[2px] border-yellow-500/80 rounded-md hover:bg-yellow-500/80 group">
                <i class="fa-solid fa-pen-to-square text-yellow-500 group-hover:text-white"></i>
            </a>';

        $buttonDelete =
            '<button type="button" href="'.route('business.patient.destroy', $id).'" title="delete" class="ajax grow flex justify-center items-center py-1 border-[2px] rounded-md border-red-500/80 hover:bg-red-500/80 group">
                <i class="fa-solid fa-trash text-red-500 group-hover:text-white"></i>
            </button>';

        return $buttonShow.$buttonEdit.$buttonDelete;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $business = auth()->user()->business->first();
        if ($request->ajax()) {
            $data = $business->user()->whereRole('patient')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return
                    '<div class="flex shrink gap-1">
                        '.$this->getUserButtons($data).'
                    </div>';
                })->editColumn('name', function($data){
                    return $data->name . ' ' . $data->last_name;
                })->editColumn('date_of_birth', function($data){
                    return date("d-m-Y", strtotime($data->date_of_birth));
                })->rawColumns(['action'])->make(true);
        }

        return view('business.patient.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skin_type = ['grassa', 'secca', 'alipidica', 'mista', 'sensibile', 'acneica', 'couperose', 'rugosa', 'discromia', 'asfittica'];
        return view('business.patient.create', compact('skin_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $validated = $request->validate([
            'role' => ['required'],
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'foreigner' => ['nullable', 'boolean'],
            'image_profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg'],
            'cf' => ['nullable', 'regex:/^[A-Za-z]{6}[0-9]{2}[A-Za-z]{1}[0-9]{2}[A-Za-z]{1}[0-9]{3}[A-Za-z]{1}$/'],
            'date_of_birth' => ['nullable', 'string'],
            'birth_place' => ['nullable', 'string'],
            'country_of_birth' => ['nullable', 'string'],
            'sex' => ['nullable', 'boolean'],
            'height' => ['nullable', 'numeric'],
            'profession' => ['nullable', 'string'],
            'business_name' => ['nullable', 'string'],
            'p_iva' => ['nullable', 'numeric', 'regex:/^[0-9]{11}$/'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'mobile_phone' => ['required', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'telephone' => ['nullable', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'address' => ['nullable', 'string'],
            'civic' => ['nullable', 'numeric'],
            'city' => ['nullable', 'string'],
            'province' => ['nullable', 'string'],
            'cap' => ['nullable', 'numeric'],
            'allergies' => ['nullable', 'string'],
            'interventions' => ['nullable', 'string'],
            'patologys' => ['nullable', 'string'],
            'medications' => ['nullable', 'string'],
            'disturbance' => ['nullable', 'string'],
            'artrosi' => ['nullable', 'boolean'],
            'placche' => ['nullable', 'string'],
            'diseases' => ['nullable', 'string'],
            'covid_vaccine' => ['nullable', 'boolean'],
            'sport' => ['nullable', 'boolean'],
            'diuresi' => ['nullable', 'string'],
            'diuresi_qta' => ['nullable', 'numeric'],
            'menopause' => ['nullable', 'boolean'],
            'cicle' => ['nullable', 'boolean'],
            'contraceptive' => ['nullable', 'boolean'],
            'smoker' => ['nullable', 'boolean'],
            'pregnancy' => ['nullable', 'numeric'],
            'cellulite' => ['nullable', 'string'],
            'intestine' => ['nullable', 'string'],
            'knows' => ['nullable', 'string'],
            'alimentation' => ['nullable', 'boolean'],
            'alimentation_note' => ['nullable', 'string'],
            'alimentation_follow' => ['nullable', 'boolean'],
            'alimentation_since' => ['nullable', 'string'],
            'drenant' => ['nullable', 'string'],
            'integration' => ['nullable', 'string'],
            'aesthetics' => ['nullable', 'boolean'],
            'adipe' => ['nullable', 'boolean'],
            'skin_relax' => ['nullable', 'boolean'],
            'teleangectasia' => ['nullable', 'boolean'],
            'body_cream' => ['nullable', 'string'],
            'face_cream' => ['nullable', 'string'],
            'skin' => ['nullable', 'string'],
            'skin_blemishes' => ['nullable', 'string'],
            'body_blemishes' => ['nullable', 'string'],
            'solar_lamp' => ['nullable', 'boolean'],
        ]);
        $validated['role'] = 'patient';

        $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $combLen = strlen($comb) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $combLen);
            $pass[] = $comb[$n];
        }
        $validated['password'] = implode($pass);
dd($validated);
        $patient = User::create($validated);

        $business = auth()->user()->business->first();
        if (array_key_exists('image_profile', $validated)) {
            $file_path = Storage::disk('public')->put('business-'. $business->id . '/' . 'Patients' . '/' . 'patient-' . $patient->id . '/' . 'image_profile', $validated['image_profile']);
            $validated['image_profile'] = $file_path;
            $patient->update($validated);
        }

        $business = auth()->user()->business->first();
        $patient->business()->attach($business);

        return redirect()->route('business.patient.index')->with('message', "Paziente $patient->name $patient->last_name registrato!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = User::find($id);

        return view('business.patient.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = User::find($id);

        return view('business.patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = User::find($id);
        $patient->delete();

        return redirect()->back()->with('message', "Paziente $patient->last_name $patient->name eliminato!");
    }
}
