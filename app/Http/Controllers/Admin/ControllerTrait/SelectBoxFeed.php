<?php 

namespace App\Http\Controllers\Admin\ControllerTrait;

trait SelectBoxFeed
{

	/**
	 * Handle (GET) ajax request from: /admin/mapel/select-box/feed/bidang
	 * 
	 * @param  \App\Services\SelectBoxGenerator $selectBox 
	 * @return Response                                              
	 */
	public function selectBoxFeedBidang(\App\Services\SelectBoxGenerator $selectBox)
	{
		return $selectBox->generateBidangKeahlian();
	}


	/**
	 * Handle (GET) ajax request from: /admin/mapel/select-box/feed/program/{bidang_id}
	 *
	 * @param integer 									$bidang_id
	 * @param  \App\Services\SelectBoxGenerator $selectBox 
	 * @return Response                                              
	 */
	public function selectBoxFeedProgram($bidang_id, \App\Services\SelectBoxGenerator $selectBox)
	{
		return $selectBox->generateProgramKeahlian($bidang_id);
	}


	/**
	 * Handle (GET) ajax request from: admin/mapel/select-box-feed/paket/{program_id}
	 * 
	 * @param  integer                                   $bidang_id 
	 * @param  \App\Services\SelectBoxGenerator $selectBox 
	 * @return Response                                              
	 */
	public function selectBoxFeedPaket($program_id, \App\Services\SelectBoxGenerator $selectBox)
	{
		return $selectBox->generatePaketKeahlian($program_id);
	}


	/**
	 * Handle (GET) ajax request from: /admin/kompetensi-dasar/mapel/{paket_id}
	 * @param  [type]                           $paket_id  [description]
	 * @param  \App\Services\SelectBoxGenerator $selectBox [description]
	 * @return [type]                                      [description]
	 */
	public function selectBoxFeedMapel($paket_id, \App\Services\SelectBoxGenerator $selectBox)
	{
		return $selectBox->generateMapel($paket_id);
	}
}