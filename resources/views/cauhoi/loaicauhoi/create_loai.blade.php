@if( Session::get('loaicauhoi') == Config::get('constants.options.1'))
  <div class="loaicauhoi">
    <table>
      <tbody class="text-center">
      <tr>
        <td class="w50">
          <label>A:</label>
        </td>
        <td>{{ Form::text('phuongan[]', '', ['class' => 'form-control']) }}</td>
        <td class="w50">{{ Form::radio('dapan[]', '1', true) }}</td>
      </tr>
      </tbody>
    </table>
  </div>
  <div class="loaicauhoi">
    <table>
      <tbody class="text-center">
      <tr>
        <td class="w50">
          <label>B:</label>
        </td>
        <td>{{ Form::text('phuongan[]', '', ['class' => 'form-control']) }}</td>
        <td class="w50">{{ Form::radio('dapan[]', '2') }}</td>
      </tr>
      </tbody>
    </table>
  </div>
  <div class="loaicauhoi">
    <table>
      <tbody class='text-center'>
      <tr>
        <td class="w50">
          <label>C:</label>
        </td>
        <td>{{ Form::text('phuongan[]', '', ['class' => 'form-control']) }}</td>
        <td class="w50">{{ Form::radio('dapan[]', '3') }}</td>
      </tr>
      </tbody>
    </table>
  </div>
  <div class="loaicauhoi">
    <table>
      <tbody class='text-center'>
      <tr>
        <td class="w50">
          <label>D:</label>
        </td>
        <td>{{ Form::text('phuongan[]', '', ['class' => 'form-control']) }}</td>
        <td class="w50">{{ Form::radio('dapan[]', '4') }}</td>
      </tr>
      </tbody>
    </table>
  </div>
@elseif( Session::get('loaicauhoi') == Config::get('constants.options.2'))
  <div class="loaicauhoi">
    <table>
      <tbody class="text-center">
      <tr>
        <td class="w50">
          <label>A:</label>
        </td>
        <td>{{ Form::text('phuongan[]', '', ['class' => 'form-control']) }}</td>
        <td class="w50">{{ Form::checkbox('dapan[]', '1', true) }}</td>
      </tr>
      </tbody>
    </table>
  </div>
  <div class="loaicauhoi">
    <table>
      <tbody class="text-center">
      <tr>
        <td class="w50">
          <label>B:</label>
        </td>
        <td>{{ Form::text('phuongan[]', '', ['class' => 'form-control']) }}</td>
        <td class="w50">{{ Form::checkbox('dapan[]', '2') }}</td>
      </tr>
      </tbody>
    </table>
  </div>
  <div class="loaicauhoi">
    <table>
      <tbody class='text-center'>
      <tr>
        <td class="w50">
          <label>C:</label>
        </td>
        <td>{{ Form::text('phuongan[]', '', ['class' => 'form-control']) }}</td>
        <td class="w50">{{ Form::checkbox('dapan[]', '3') }}</td>
      </tr>
      </tbody>
    </table>
  </div>
  <div class="loaicauhoi">
    <table>
      <tbody class='text-center'>
      <tr>
        <td class="w50">
          <label>D:</label>
        </td>
        <td>{{ Form::text('phuongan[]', '', ['class' => 'form-control']) }}</td>
        <td class="w50">{{ Form::checkbox('dapan[]', '4') }}</td>
      </tr>
      </tbody>
    </table>
  </div>
@elseif( Session::get('loaicauhoi') == Config::get('constants.options.3'))
  <div class="loaicauhoi">
    <table>
      <tbody class="text-center">
      <tr>
        <td class="w150">{{ Form::radio('dapan[]', 'Đúng', true) }}
        <!-- &emsp;Đúng -->
          {{Form::label('Đúng', 'Đúng')}}
        </td>
        <td class="w150">{{ Form::radio('dapan[]', 'Sai') }}
        <!-- &emsp;Sai -->
          {{Form::label('Sai', 'Sai')}}
        </td>
      </tr>
      </tbody>
    </table>
  </div>
@endif
