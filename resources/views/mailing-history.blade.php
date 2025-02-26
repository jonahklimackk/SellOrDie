<x-app-layout>



	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="mt-8 ml-8">


                            <h1 class=" text-2xl font-medium text-gray-900 dark:text-white">
                            Mailing History</h1>
                        </div>



<div align="center">
<table class="mt-10 mb-10 border-spacing border-separate-2 border border-slate-400 table-auto bgcolor-red-300">
				<thead>
					<tr>
						<th>Subject</th>
						<th>Send Date</th>
						<th>Status </th>
						<th>recipients</th>
						<th>opens</th>
						<th>clicks</th>
					</tr>
				</thead>
				<tbody>

					@foreach($mailings as $mailing)
					<tr>
						<td width="250px"> {{ $mailing->subject }}</td>
						<td width="90px" style="text-align: center">{{ $mailing->updated_at }}</td>
						<td width="120px" style="text-align: center">
							{{ $mailing->status }}
						</td>
						<td width="120px" style="text-align: center">
							{{ $mailing->recipients }}
						</td>
						<td width="120px" style="text-align: center">
							{{ $mailing->views }}
						</td>
						<td width="100px" style="text-align: center">
							{{ $mailing->clicks }}

					</tr>
					@endforeach


				</tbody>
			</table>


</div>
			</div>
		</div>
	</div>
</x-app-layout>