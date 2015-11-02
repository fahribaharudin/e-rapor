<?php 

namespace App\Http\Controllers\Admin\ControllerTrait;

trait SelectBoxFeed
{

	/**
	 * Handle (GET) ajax request from: /admin/mapel/select-box/feed/bidang
	 * 
	 * @param  \App\Services\KeahlianSelectBoxGenerator $selectBox 
	 * @return Response                                              
	 */
	public function selectBoxFeedBidang(\App\Services\KeahlianSelectBoxGenerator $selectBox)
	{
		return $selectBox->generateBidangKeahlian();
	}


	/**
	 * Handle (GET) ajax request from: /admin/mapel/select-box/feed/program/{bidang_id}
	 *
	 * @param integer 									$bidang_id
	 * @param  \App\Services\KeahlianSelectBoxGenerator $selectBox 
	 * @return Response                                              
	 */
	public function selectBoxFeedProgram($bidang_id, \App\Services\KeahlianSelectBoxGenerator $selectBox)
	{
		return $selectBox->generateProgramKeahlian($bidang_id);
	}


	/**
	 * Handle (GET) ajax request from: admin/mapel/select-box-feed/paket/{program_id}
	 * 
	 * @param  integer                                   $bidang_id 
	 * @param  \App\Services\KeahlianSelectBoxGenerator $selectBox 
	 * @return Response                                              
	 */
	public function selectBoxFeedPaket($program_id, \App\Services\KeahlianSelectBoxGenerator $selectBox)
	{
		return $selectBox->generatePaketKeahlian($program_id);
	}
}