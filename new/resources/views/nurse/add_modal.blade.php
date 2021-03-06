<div class="modal fade" id="addNurse" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hamshira qo'shish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form style="overflow: auto;" action="/nurse/add" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-3">
              <h5 style="text-align: right !important;">PINFL orqali qidirish</h5>
            </div>
            <div class="col-6">
              <input type="text" class="form-control" name="search_pinfl" id="search_pinfl" value="{{ old('search_pinfl') }}">
            </div>
            <div class="col-3"></div>
          </div>
          @csrf
          <div class="row">
            <h4 class="text-center">Shaxsiy ma'lumotlar</h4>
            <div class="col-3">
              <label class="form-label">Ism</label>
              <input class="form-control mb-3" type="text" name="name" id="name" value="{{ old('name') }}" required>
              @error('name')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="col-3">
              <label class="form-label">Familiya</label>
              <input class="form-control mb-3" type="text" name="surname" id="surname" value="{{ old('surname') }}" required>
              @error('surname')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="col-3">
              <label class="form-label">Otasini ismi</label>
              <input class="form-control mb-3" type="text" name="patronymic" id="patronymic" value="{{ old('patronymic') }}" required>
              @error('patronymic')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="col-3">
              <label class="form-label">Tugilgan yili</label>
              <input class="form-control mb-3" type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required>
              @error('birth_date')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="col-3">
              <label class="form-label">Pasport</label>
              <input class="form-control mb-3" type="text" name="passport" id="passport" value="{{ old('passport') }}" required>
              @error('passport')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="col-3">
              <label class="form-label">PINFL</label>
              <input class="form-control mb-3" type="text" name="pinfl" id="pinfl" value="{{ old('pinfl') }}" required>
              @error('pinfl')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="col-3">
              <label class="form-label">Ma'lumoti</label>
              <select class="form-select mb-3" name="degree" id="degree">
                <option>Tanlang</option>
                <option value="1">O'rta maxsus</option>
                <option value="2">Oliy</option>
              </select>
              @error('degree')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="col-3">
              <label class="form-label"> Mustaqil hamshira ma???lumotnomasi</label>
              <input class="form-control mb-3" type="file" name="licence_file" value="" required>
              @error('licence_file')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
          </div>
          <div class="row">
            <h4 class="text-center">Diplom ma'lumotlari</h4>
            <div class="col-3">
              <label class="form-label">Diplom bergan muassasa</label>
              <input name="diploma_institution"  class="form-control mb-3" type="text" value="{{ old('diploma_institution') }}" required>
              {{--                                <select class="form-select mb-3" name="diploma_institution" id="diploma_institution">--}}
              {{--                                    <option>Tanlang</option>--}}
              {{--                                    @forelse($colleges as $college)--}}
              {{--                                        <option value="{{ $college->id }}" {{ old('diploma_institution') == $college->id ? "selected" :""}}>{{ $college->title }}</option>--}}
              {{--                                    @empty--}}
              {{--                                    @endforelse--}}
              {{--                                </select>--}}
              @error('diploma_institution')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="col-3">
              <label class="form-label">Diplom raqami</label>
              <input class="form-control mb-3" type="text" name="diploma_number" value="{{ old('diploma_number') }}" required>
              @error('diploma_number')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="col-3">
              <label class="form-label">Diplom berilgan sana</label>
              <input class="form-control mb-3" type="date" name="diploma_date" value="{{ old('diploma_date') }}" required>
              @error('diploma_date')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="col-3">
              <label class="form-label">Diplom nusxasi</label>
              <input class="form-control mb-3" type="file" name="diploma_file" value="" required>
              @error('diploma_file')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <h4 class="text-center">Sertifikat malumotlari</h4>
            <div class="col-3">
              <label class="form-label">Sertifikat bergan muassasa</label>
              <select class="form-select mb-3" name="certificate_institution" id="certificate_institution">
                <option>Tanlang</option>
                @forelse($centers as $center)
                  <option value="{{ $center->id }}" {{ old('certificate_institution') == $center->id ? "selected" :""}}>{{ $center->title }}</option>
                @empty
                @endforelse
              </select>
              @error('certificate_institution')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="col-3">
              <label class="form-label">Sertifikat raqami</label>
              <input class="form-control mb-3" type="text" name="certificate_number" value="{{ old('certificate_number') }}">
              @error('certificate_number')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="col-3">
              <label class="form-label">Sertifikat berilgan sana</label>
              <input class="form-control mb-3" type="date" name="certificate_date" value="{{ old('certificate_date') }}">
              @error('certificate_date')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="col-3">
              <label class="form-label">Sertifikat nusxasi</label>
              <input class="form-control mb-3" type="file" name="certificate_file" value="">
              @error('certificate_file')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
          </div>
          <div class="row">
            <h4 class="text-center">Qo'shimcha ma'lumotlari</h4>
            <div class="col-4">
              <label class="form-label">Yo'nalish</label>
              <select class="form-select mb-3" name="category_id" id="category_id" required>
                <option>Tanlang</option>
                @forelse($categories as $category)
                  <option value="{{ $category->id }}" >{{ $category->title }}</option>
                @empty
                @endforelse
              </select>
              @error('category_id')
              <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
              @enderror
            </div>
            <div class="col-4">
              <label class="form-label">Hamkor muassasa</label>
              <select class="form-select mb-3" name="partner_polyclinic" id="partner_polyclinic" required>
                <option>Tanlang</option>
                @forelse($polyclinics as $polyclinic)
                  <option value="{{ $polyclinic->id }}" >{{ $polyclinic->title }}</option>
                @empty
                @endforelse
              </select>
              @error('partner_polyclinic')
              <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
              @enderror
            </div>
            <div class="col-4">
              <label class="form-label">Hudud</label>
              <input class="form-control mb-3" type="text" name="area" value="{{ old('area') }}">
              @error('area')
              <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="col-4">
              <label class="form-label">Telefon</label>
              <input class="form-control mb-3" type="number" name="phone" id="phone" value="{{ old('phone') }}" required>
              @error('phone')
              <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
              @enderror
            </div>
            <div class="col-4">
              <label class="form-label">Parol</label>
              <input class="form-control mb-3" type="text" name="password" id="password" value="" required>
              @error('password')
              <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
              @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-primary">Saqlash</button>
        </div>
      </form>
    </div>
  </div>
</div>
