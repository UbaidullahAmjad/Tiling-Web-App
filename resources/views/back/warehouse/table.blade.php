@foreach($datas as $data)
      <tr>
            <td>
                  {{ $data->name }}
            </td>

            

            <td>
                  {{ $data->delivery_time }}
            </td>

          
            <td>
            <div class="action-list">
                  <a class="btn btn-secondary btn-sm "
                        href="{{ route('back.warehouse.edit',$data->id) }}">
                        <i class="fas fa-edit"></i>
                  </a>
                  <a class="btn btn-danger btn-sm " data-toggle="modal"
                        data-target="#confirm-delete" href="javascript:;"
                        data-href="{{ route('back.warehouse.delete',$data->id) }}">
                        <i class="fas fa-trash-alt"></i>
                  </a>
            </div>
      </td>
</tr>
@endforeach
