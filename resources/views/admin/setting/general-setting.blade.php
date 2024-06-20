<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.general-setting-update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label> Site Name</label>
                    <input type="text" class="form-control" name="site_name" value="{{ @$generalSettings->site_name }}">
                </div>
                <div class="form-group">
                    <label>Contact Email</label>
                    <input type="text" class="form-control" name="contact_email" value="{{ @$generalSettings->contact_email }}">
                </div>
                <div class="form-group">
                    <label>Default Currency Name</label>
                    <select id="" class="form-control" name="currency_name">
                        <option value="">Select</option>
                            @foreach(config('settings.currecy_list') as $currency )
                                <option {{ @$generalSettings->currency_name === $currency ? 'selected' : ''}} value="{{ $currency }}">{{ $currency }}</option>
                            @endforeach
                        
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency Icon</label>
                    <input type="text" class="form-control" name="currency_icon" value="{{ @$generalSettings->currency_icon }}">
                </div>
                <button type="submit" class="btn btn-primary" >Update</button>
            </form>    
        </div>    
    </div>  
</div>