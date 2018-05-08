@if( $cauhoi->loaicauhoi == Config::get('constants.options.1'))
  <div class="loaicauhoi">
    <table>
      <tbody class="text-center">
      <tr>
        <td class="w50">
          <label>A:</label>
        </td>
        <td>{{ Form::text('phuongan[]', $cau[0], ['class' => 'form-control']) }}</td>
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
        <td>{{ Form::text('phuongan[]', $cau[1], ['class' => 'form-control']) }}</td>
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
        <td>{{ Form::text('phuongan[]', $cau[2], ['class' => 'form-control']) }}</td>
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
        <td>{{ Form::text('phuongan[]', $cau[3], ['class' => 'form-control']) }}</td>
        <td class="w50">{{ Form::radio('dapan[]', '4') }}</td>
      </tr>
      </tbody>
    </table>
  </div>
@elseif( $cauhoi->loaicauhoi == Config::get('constants.options.2'))
  <div class="loaicauhoi">
    <table>
      <tbody class="text-center">
      <tr>
        <td class="w50">
          <label>A:</label>
        </td>
        <td>{{ Form::text('phuongan[]', $cau[0], ['class' => 'form-control']) }}</td>
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
        <td>{{ Form::text('phuongan[]', $cau[1], ['class' => 'form-control']) }}</td>
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
        <td>{{ Form::text('phuongan[]', $cau[2], ['class' => 'form-control']) }}</td>
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
        <td>{{ Form::text('phuongan[]', $cau[3], ['class' => 'form-control']) }}</td>
        <td class="w50">{{ Form::checkbox('dapan[]', '4') }}</td>
      </tr>
      </tbody>
    </table>
  </div>
@elseif( $cauhoi->loaicauhoi == Config::get('constants.options.3'))
  <div class="loaicauhoi">
    <table>
      <tbody class="text-center">
      <tr>
        <td class="w150">{{ Form::radio('dapan[]', $cau[0], true) }}&emsp;Đúng</td>
        <td class="w150">{{ Form::radio('dapan[]', $cau[1]) }}&emsp;Sai</td>
      </tr>
      </tbody>
    </table>
  </div>
@endif
