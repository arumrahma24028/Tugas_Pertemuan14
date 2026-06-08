<?php
 
namespace App\Http\Requests;
 
use App\Rules\KodeBukuFormat;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreBukuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //Custom Rule KodeBukuFormat yang sudah dibuat sebelumnya
            'kode_buku' => ['required', 'string', 'max:20', 'unique:buku,kode_buku', new KodeBukuFormat],
            'judul' => 'required|string|max:200',
            'kategori' => 'required|in:Programming,Database,Web Design,Networking,Data Science',
            'pengarang' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'isbn' => 'nullable|string|max:20',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'bahasa' => 'required|string|max:20',
        ];
    }
 
    /**
     * Configure the validator instance and add conditional validation.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            // Kondisi 1: Jika kategori "Programming", field bahasa harus "Inggris"
            if ($this->kategori === 'Programming' && strtolower($this->bahasa) !== 'inggris') {
                $validator->errors()->add('bahasa', 'Untuk kategori Programming, bahasa buku harus berupa "Inggris".');
            }

            // Kondisi 2: Jika tahun terbit < 2000, stok maksimal 5
            if ($this->tahun_terbit < 2000 && $this->stok > 5) {
                $validator->errors()->add('stok', 'Untuk buku terbitan di bawah tahun 2000, stok maksimal adalah 5.');
            }
        });
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'kode_buku.required' => 'Kode buku wajib diisi.',
            'kode_buku.unique' => 'Kode buku sudah digunakan.',
            'kode_buku.max' => 'Kode buku maksimal 20 karakter.',
            'judul.required' => 'Judul buku wajib diisi.',
            'judul.max' => 'Judul buku maksimal 200 karakter.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in' => 'Kategori yang dipilih tidak valid.',
            'pengarang.required' => 'Nama pengarang wajib diisi.',
            'pengarang.max' => 'Nama pengarang maksimal 100 karakter.',
            'penerbit.required' => 'Nama penerbit wajib diisi.',
            'penerbit.max' => 'Nama penerbit maksimal 100 karakter.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.integer' => 'Tahun terbit harus berupa angka bulat.',
            'tahun_terbit.min' => 'Tahun terbit minimal tahun 1900.',
            'tahun_terbit.max' => 'Tahun terbit tidak boleh melebihi tahun sekarang.',
            'isbn.max' => 'ISBN maksimal 20 karakter.',
            'harga.required' => 'Harga buku wajib diisi.',
            'harga.numeric' => 'Harga harus berupa nilai angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0 atau bernilai negatif.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka bulat.',
            'stok.min' => 'Stok tidak boleh kurang dari 0 atau bernilai negatif.',
            'bahasa.required' => 'Bahasa wajib diisi.',
            'bahasa.max' => 'Nama bahasa maksimal 20 karakter.',
        ];
    }
 
    /**
     * Get custom attribute names.
     */
    public function attributes(): array
    {
        return [
            'kode_buku' => 'kode buku',
            'judul' => 'judul buku',
            'kategori' => 'kategori',
            'pengarang' => 'nama pengarang',
            'penerbit' => 'nama penerbit',
            'tahun_terbit' => 'tahun terbit',
            'isbn' => 'ISBN',
            'harga' => 'harga',
            'stok' => 'stok',
            'bahasa' => 'bahasa',
            'deskripsi' => 'deskripsi',
        ];
    }
}