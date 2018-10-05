<?php
	include_once("../../common.php");
	$back_url = G5_URL;
	$title = "기뷰이용약관";
	include_once(G5_PATH."/head.etc.php");
	if(!$type){
		$type="short";
	}
	$best_tel=sql_fetch("select * from `best_tel`");
	$query=sql_query("select * from best_model as m inner join best_car as c on m.id=c.model");
	while($data=sql_fetch_array($query)){
		$list[]=$data;
	}
?>
    <div class="width-fixed">
		<ul class="sub_ul">
			<li class="active" >기뷰이용약관</li>
			<li onclick="location.href='<?php echo G5_URL?>/page/guide/location_agreement.php'">위치기반 서비스 이용약관</li>
		</ul>
		<div class="clear"></div>
		<!-- <section class="section01">
			<header class="section01_header">
				<h1>이용약관</h1>
				<h3 class="agreement_head"></h3>
				<p>(주)엔조이라이프의 이용약관에 대해 알려드립니다.</p>
			</header>
		</section> -->
		<div class="contain">
			<div class="guide_top_txt">
			</div>
			<div class="guide_common_wrap">
				<p class="list_title">제1장. 총칙</p>
				<div>
					<p class="list_title">제1조(목적)</p>
					 <ol>
						<li>본 약관은 (주)엔조이라이프(이하 "회사"라 합니다)가 제공하는 전자지급결제대행서비스, 선불전자지급수단의 발행 및 관리서비스, 직불전자지급수단의 발행 및 관리서비스, 결제대금예치서비스, 전자고지결제서비스(이하 통칭하여 "전자금융거래서비스"라 합니다)를 "회원"이 이용함에 있어, "회사"와 "회원" 간 권리, 의무 및 "회원"의 서비스 이용절차 등에 관한 사항을 규정하는 것을 그 목적으로 합니다.</li>
					 </ol>
				</div>
				<div>
					<p class="list_title">제2조(정의)</p>
					<ol>
						<li>(1) 본 약관에서 정한 용어의 정의는 아래와 같습니다.
							<ol>
								<li>① "전자금융거래"라 함은 "회사"가 "전자적 장치"를 통하여 전자금융업무를 제공하고, "회원"이 "회사"의 종사자와 직접 대면하거나 의사소통을 하지 아니하고 자동화된 방식으로 이를 이용하는 거래를 말합니다.</li>
								<li>② "전자지급거래"라 함은 자금을 주는 자(이하 "지급인"이라 합니다)가 "회사"로 하여금 전자지급수단을 이용하여 자금을 받는 자(이하 "수취인"이라 합니다)에게 자금을 이동하게 하는 "전자금융거래"를 말합니다.</li>
								<li>③ "전자적 장치"라 함은 "전자금융거래" 정보를 전자적 방법으로 전송하거나 처리하는데 이용되는 장치로써 현금자동지급기, 자동입출금기, 지급용단말기, 컴퓨터, 전화기 그 밖에 전자적 방법으로 정보를 전송하거나 처리하는 장치를 말합니다.</li>
								<li>④ "접근매체"라 함은 "전자금융거래"에 있어서 "거래지시"를 하거나 이용자 및 거래내용의 진실성과 정확성을 확보하기 위하여 사용되는 수단 또는 정보로서 "전자금융거래서비스"를 이용하기 위하여 "회사"에 등록된 아이디 및 비밀번호, 기타 "회사"가 지정한 수단을 말합니다.</li>
								<li>⑤ "아이디"란 "회원"의 식별과 서비스 이용을 위하여 "회원"이 설정하고 "회사"가 승인한 숫자와 문자의 조합을 말합니다.</li>
								<li>⑥ "비밀번호"라 함은 "회원"의 동일성 식별과 "회원" 정보의 보호를 위하여 "회원"이 설정하고 "회사"가 승인한 숫자와 문자의 조합을 말합니다.</li>
								<li>⑦ "회원"이라 함은 본 약관에 동의하고 본 약관에 따라 "회사"가 제공하는 "전자금융거래서비스"를 이용하는 자를 말합니다.</li>
								<li>⑧ "판매자"라 함은 "전자금융거래서비스"를 통하여 "회원"에게 재화 또는 용역(이하 "재화 등"이라 합니다)을 판매하는 자를 말합니다.</li>
								<li>⑨ "거래지시"라 함은 "회원"이 본 약관에 따라 "회사"에게 "전자금융거래"의 처리를 지시하는 것을 말합니다.</li>
								<li>⑩ "오류"라 함은 "회원"의 고의 또는 과실 없이 "전자금융거래"가 본 약관 또는 "회원"의 "거래지시"에 따라 이행되지 아니한 경우를 말합니다.</li>
							</ol>
						<li>(2) 본 조 및 본 약관의 다른 조항에서 정의한 것을 제외하고는 전자금융거래법 등 관련 법령에 정한 바에 따릅니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제3조 (약관의 명시 및 변경)</p>
					<ol>
						 <li>(1) "회사"는 "회원"이 "전자금융거래"를 하기 전에 본 약관을 서비스 페이지에 게시하고 본 약관의 중요한 내용을 확인할 수 있도록 합니다.</li>
						 <li>(2) "회사"는 "회원"의 요청이 있는 경우 전자문서의 전송(이하 전자우편을 이용한 전송을 포함합니다), 모사전송, 우편 또는 직접 교부의 방식에 의하여 본 약관의 사본을 "회원"에게 교부합니다.</li>
						 <li>(3) "회사"가 본 약관을 변경하는 때에는 그 시행일 1월 전에 변경되는 약관을 금융거래정보 입력화면 또는 서비스 홈페이지에 게시함으로써 "회원"에게 공지합니다. 다만, 법령의 개정으로 인하여 긴급하게 약관을 변경하는 때에는 변경된 약관을 서비스 홈페이지에 1개월 이상 게시하고 이용자에게 통지합니다.</li>
						 <li>(4) "회사"는 제(3)항의 공지나 통지를 할 경우, "이용자가 변경에 동의하지 아니한 경우 공지나 통지를 받은 날로부터 30일 이내에 계약을 해지할 수 있으며, 계약해지의 의사표시를 하지 아니한 경우에는 변경에 동의한 것으로 본다."라는 취지의 내용을 공지합니다.</li>
					</ol>
				</div>	
				<div>
					<p class="list_title">제4조 (거래내용의 확인)</p>
					<ol>
						 <li>(1) "회사"는 서비스 페이지의 ‘구매내역’ 조회 화면 을 통하여 "회원"의 거래내용("회원"의 "오류" 정정 요구사실 및 처리결과에 관한 사항을 포함합니다)을 확인할 수 있도록 하며, "회원"이 거래내용에 대해 서면 교부를 요청하는 경우에는 요청을 받은 날로부터 2주 이내에 모사전송, 우편 또는 직접 교부의 방법으로 거래내용에 관한 서면을 교부합니다.</li>
						 <li>(2) "회사"는 제(1)항에 따른 "회원"의 거래내용 서면 교부 요청을 받은 경우 "전자적 장치"의 운영장애, 그 밖의 사유로 거래내용을 제공할 수 없는 때에는 즉시 "회원"에게 전자문서 전송의 방법으로 그러한 사유를 알려야 하며, "전자적 장치"의 운영장애 등의 사유로 거래내용을 제공할 수 없는 기간은 제(1)항의 거래내용에 관한 서면의 교부기간에 산입하지 아니합니다.</li>
						 <li>(3) 제(1)항의 대상이 되는 거래내용 중 대상기간이 5년인 것은 다음 각 호와 같습니다.
							<ol>
								<li>① 거래계좌의 명칭 또는 번호</li>
								<li>② "전자금융거래"의 종류 및 금액</li>
								<li>③ "전자금융거래"의 상대방에 관한 정보</li>
								<li>④ "전자금융거래"의 거래일시</li>
								<li>⑤ "전자적 장치"의 종류 및 "전자적 장치"를 식별할 수 있는 정보</li>
								<li>⑥ "회사"가 "전자금융거래"의 대가로 받은 수수료</li>
								<li>⑦ "회원"의 출금 동의에 관한 사항</li>
								<li>⑧ "전자금융거래"의 신청 및 조건의 변경에 관한 사항</li>
							</ol>
						</li>
						 <li>(4) 제(1)항의 대상이 되는 거래내용 중 대상기간이 1년인 것은 다음 각 호와 같습니다.
							<ol>
								<li>① "회원"의 "오류" 정정 요구사실 및 처리결과에 관한 사항</li>
								<li>② 기타 금융위원회가 고시로 정한 사항</li>
							</ol>
						</li>
						 <li>(5) "회원"이 제(1)항에서 정한 서면 교부를 요청하고자 할 경우 다음의 주소 및 전화번호로 요청할 수 있습니다.
							<ol>
								<li>① 주소: 충청북도 청주시 서원구 수영로 27-1(수곡동)</li>
								<li>② 이메일 주소: </li>
								<li>③ 전화번호: </li>
							</ol>
						</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제5조 ("거래지시"의 철회 등)</p>
					<ol>
						<li>(1) "회원"이 "회사"의 "전자금융거래서비스"를 이용하여 "전자지급거래"를 한 경우, "회원"은 지급의 효력이 발생하기 전까지 본 약관에서 정한 바에 따라 제4조 제⑤항에 기재된 연락처로 전자문서의 전송 또는 서비스 페이지 내 철회에 의한 방법으로 "거래지시"를 철회할 수 있습니다. 단, 각 서비스 별 "거래지시" 철회의 효력 발생시기는 본 약관 제16조, 제24조, 제29조, 제33조, 제35조에서 정한 바에 따릅니다.</li>
						<li>(2) "회원"은 전자지급의 효력이 발생한 경우에 전자상거래 등에서의 소비자보호에 관한 법률 등 관련 법령상 청약 철회의 방법에 따라 결제대금을 반환 받을 수 있습니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제6조 ("오류"의 정정 등)</p>
					<ol>
						<li>(1) "회원"은 "전자금융거래서비스"를 이용함에 있어 "오류"가 있음을 안 때에는 "회사"에 대하여 그 정정을 요구할 수 있습니다.</li>
						<li>(2) "회사"는 전 항의 규정에 따른 "오류"의 정정 요구를 받은 때 또는 스스로 "전자금융거래"에 "오류"가 있음을 안 때에는 이를 즉시 조사하여 처리한 후 정정 요구를 받은 날 또는 "오류"가 있음을 안 날부터 2주 이내에 그 결과를 문서, 전화 또는 전자우편으로 "회원"에게 알려 드립니다. 다만, "회원"이 문서로 알려줄 것을 요청하는 경우에는 문서로 알려 드립니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제7조 ("전자금융거래" 기록의 생성 및 보존)</p>
					<ol>
						<li>(1) "회사"는 "회원"이 이용한 "전자금융거래"의 내용을 추적, 검색하거나 그 내용에 "오류"가 발생한 경우에 이를 확인하거나 정정할 수 있는 기록을 보존합니다.</li>
						<li>(2) 전 항의 규정에 따라 "회사"가 보존하여야 하는 기록의 종류 및 보존기간은 다음 각 호와 같습니다.
							<ol>
								<li>① 다음 각 목의 거래기록은 5년간 보존하여야 합니다.
									<ol>
										<li>가. 제4조 제(3)항 제①호 내지 제⑧호에 관한 사항</li>
										<li>나. 해당 "전자금융거래"와 관련한 "전자적 장치"의 접속기록</li>
										<li>다. 건당 거래금액이 1만원을 초과하는 "전자금융거래"에 관한 기록</li>
									</ol>
								</li>
								<li>② 다음 각 목의 거래기록은 1년간 보존하여야 합니다.
									<ol>
										<li>가. 제4조 제(4)항 제①호에 관한 사항</li>
										<li>나. 건당 거래금액이 1만원 이하인 "전자금융거래"에 관한 기록</li>
										<li>다. 전자지급수단 이용과 관련된 거래승인에 관한 기록</li>
										<li>라. 기타 금융위원회가 고시로 정한 사항</li>
									</ol>
								</li>
							</ol>
						</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제8조 ("전자금융거래"정보의 제공금지)</p>
					<ol>
						<li>(1) "회사"는 "전자금융거래서비스"를 제공함에 있어서 취득한 "회원"의 인적 사항, "회원"의 계좌, "접근매체" 및 "전자금융거래"의 내용과 실적에 관한 정보 또는 자료를 법령에 의하거나 "회원"의 동의를 얻지 아니하고 제3자에게 제공, 누설하거나 업무상 목적 외에 사용하지 아니합니다.</li>
						<li>(2) "회사"는 "회원"이 안전하게 "전자금융거래서비스"를 이용할 수 있도록 "회원"의 개인정보보호를 위하여 개인정보취급방침을 운용합니다. "회사"의 개인정보취급방침은 "회사"의 홈페이지 또는 서비스 페이지에 링크된 화면에서 확인할 수 있습니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제9조 ("접근매체"의 관리)</p>
					<ol>
						<li>(1) "회사"는 "전자금융거래서비스" 제공시 "접근매체"를 선정하여 "회원"의 신원, 권한 및 "거래지시"의 내용 등을 확인합니다.</li>
						<li>(2) "회원"은 "접근매체"를 사용함에 있어서 다른 법률에 특별한 규정이 없는 한 다음 각 호의 행위를 하여서는 아니됩니다.
							<ol>
								<li>① "접근매체"를 양도하거나 양수하는 행위</li>
								<li>② 대가를 수수•요구 또는 약속하면서 "접근매체"를 대여받거나 대여하는 행위 또는 보관•전달•유통하는 행위</li>
								<li>③ 범죄에 이용할 목적으로 또는 범죄에 이용될 것을 알면서 "접근매체"를 대여받거나 대여하는 행위 또는 보관•전달•유통하는 행위</li>
								<li>④ "접근매체"를 질권의 목적으로 하는 행위</li>
								<li>⑤ 제①호부터 제④호까지의 행위를 알선하는 행위</li>
							</ol>
						</li>
						<li>(3) "회원"은 자신의 "접근매체"를 제3자에게 누설 또는 노출하거나 방치하여서는 안되며, "접근매체"의 도용이나 위조 또는 변조를 방지하기 위하여 충분한 주의를 기울여야 합니다.</li>
						<li>(4) "회사"는 "회원"으로부터 "접근매체"의 분실이나 도난 등의 통지를 받은 때에는 그때부터 제3자가 그 "접근매체"를 사용함으로 인하여 "회원"에게 발생한 손해를 배상할 책임이 있습니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제10조 ("회사"의 책임)</p>
					<ol>
						<li>(1) "회사"는 다음 각 호의 어느 하나에 해당하는 사고로 인하여 "회원"에게 손해가 발생한 경우에는 그 손해를 배상할 책임을 집니다.
							<ol>
								<li>① "접근매체"의 위조나 변조로 발생한 사고(단, "회사"가 "접근매체"의 발급 주체이거나 사용, 관리 주체인 경우로 한정합니다)</li>
								<li>② 계약체결 또는 "거래지시"의 전자적 전송이나 처리 과정에서 발생한 사고</li>
								<li>③ 전자금융거래를 위한 "전자적 장치" 또는 정보통신망 이용촉진 및 정보보호 등에 관한 법률 제2조 제1항 제1호에 따른 정보통신망에 침입하여 거짓이나 그 밖의 부정한 방법으로 획득한 "접근매체"의 이용으로 발생한 사고</li>
							</ol>
						</li>
						<li>(2) "회사"는 제(1)항에도 불구하고 다음 각 호의 어느 하나에 해당하는 경우에는 그 책임의 전부 또는 일부를 "회원"이 부담하게 할 수 있습니다.
							<ol>
								<li>① "회원"이 "접근매체"를 제3자에게 대여하거나 그 사용을 위임한 경우 또는 양도나 담보의 목적으로 제공한 경우</li>
								<li>② "회원"이 제3자가 권한 없이 "회원"의 "접근매체"를 이용하여 "전자금융거래"를 할 수 있음을 알았거나 쉽게 알 수 있었음에도 불구하고 자신의 "접근매체"를 누설하거나 노출 또는 방치한 경우</li>
								<li>③ "회사"가 보안강화를 위하여 "전자금융거래"시 요구하는 추가적인 보안조치를 "회원"이 정당한 사유 없이 거부하여 제(1)항 제③호에 따른 사고가 발생한 경우</li>
								<li>④ "회원"이 제③호에 따른 추가적인 보안조치에 사용되는 매체•수단 또는 정보에 대하여 누설•노출 또는 방치하거나 제3자에게 대여하거나 그 사용을 위임한 행위 또는 양도나 담보의 목적으로 제공하는 행위를 하여 제(1)항 제③호에 따른 사고가 발생한 경우</li>
								<li>⑤ 법인(중소기업기본법 제2조 제2항에 의한 소기업을 제외합니다)인 "회원"에게 손해가 발생한 경우로서 "회사"가 사고를 방지하기 위하여 보안절차를 수립하고 이를 철저히 준수하는 등 합리적으로 요구되는 충분한 주의의무를 다한 경우</li>
							</ol>
						</li>
						<li>(3) "회사"는 "회원"으로부터 "거래지시"가 있음에도 불구하고 천재지변, "회사"의 귀책사유 없는 기타의 불가항력적인 사유로 처리 불가능하거나 지연된 경우로서 "회원"에게 처리 불가능 또는 지연 사유를 통지한 경우(금융회사 또는 결제수단발행업자나 통신판매업자가 통지한 경우를 포함합니다) 또는 "회사"가 고의•과실 없음을 입증한 경우에는 "회원"에 대하여 이로 인한 손해배상책임을 지지 아니합니다.</li>
						<li>(4) "회사"는 컴퓨터 등 정보통신설비의 보수점검, 교체의 사유가 발생하여 "전자금융거래서비스"의 제공을 일시적으로 중단할 경우에는 "회사"의 홈페이지 또는 서비스 페이지를 통하여 "회원"에게 중단 일정 및 중단 사유를 사전에 공지합니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제11조 (분쟁처리 및 분쟁조정)</p>
					<ol>
						<li>(1) "회원"은 "회사"의 서비스 페이지 하단에 게시된 분쟁처리 담당자에 대하여 "전자금융거래"와 관련한 의견 및 불만의 제기, 손해배상의 청구 등의 분쟁처리를 요구할 수 있습니다.</li>
						<li>(2) "회원"이 "회사"에 대하여 분쟁처리를 신청한 경우에는 "회사"는 15일 이내에 이에 대한 조사 또는 처리 결과를 "회원"에게 안내합니다.</li>
						<li>(3) "회원"은 "전자금융거래"의 처리에 관하여 이의가 있을 때에는 금융위원회의 설치 등에 관한 법률에 따른 금융감독원의 금융분쟁조정위원회 또는 소비자기본법에 따른 한국소비자원의 소비자분쟁조정위원회에 분쟁조정을 신청할 수 있습니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제12조 ("회사"의 안정성 확보 의무)</p>
					<ol>
						<li>"회사"는 "전자금융거래"가 안전하게 처리될 수 있도록 선량한 관리자로서의 주의를 다하며, "전자금융거래"의 안전성과 신뢰성을 확보할 수 있도록 "전자금융거래"의 종류 별로 전자적 전송이나 처리를 위한 인력, 시설, "전자적 장치" 등의 정보기술부문 및 전자금융업무에 관하여 금융위원회가 정하는 기준을 준수합니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제13조 (약관 외 준칙)</p>
					<ol>
						<li>(1) 본 약관에서 정하지 아니한 사항(용어의 정의를 포함합니다)에 대하여는 전자금융거래법, 전자상거래 등에서의 소비자보호에 관한 법률, 여신전문금융업법 등 소비자보호 관련 법령 및 개별 약관에서 정한 바에 따릅니다.</li>
						<li>(2) "회사"와 "회원" 사이에 개별적으로 합의한 사항이 이 약관에 정한 사항과 다를 때에는 그 합의사항을 이 약관에 우선하여 적용합니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제14조 (관할)</p>
					<ol>
						<li>"회사"와 "회원" 간에 발생한 분쟁에 관한 관할은 민사소송법에서 정한 바에 따릅니다.</li>
					</ol>
				</div>
				<p class="list_title">제2장 전자지급결제대행서비스</p>
				<div>
					<p class="list_title">제15조 (정의)</p>
					 <ol>
						<li>본 장에서 사용하는 용어의 정의는 다음과 같습니다.
							<ol>
								<li>① "전자지급결제대행서비스"라 함은 전자적 방법으로 재화 등의 구매에 있어서 지급결제정보를 송신하거나 수신하는 것 또는 그 대가의 정산을 대행하거나 매개하는 서비스를 말합니다.</li>
							</ol> 
						</li>
					 </ol>
				</div>
				<div>
					<p class="list_title">제16조 ("거래지시"의 철회)</p>
					<ol>
						<li>(1) "회원"이 "전자지급결제대행서비스"를 이용한 경우, "회원"은 "거래지시"된 금액의 정보에 대하여 수취인의 계좌가 개설되어 있는 금융회사 또는 "회사"의 계좌의 원장에 입금기록이 끝나거나 "전자적 장치"에 입력이 끝나기 전까지 "거래지시"를 철회할 수 있습니다.</li>
						<li>(2) "회사"는 "회원"의 "거래지시"의 철회에 따라 지급거래가 이루어지지 않은 경우 수령한 자금을 "회원"에게 반환하여야 합니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제17조 (한도 등)</p>
					<ol>
						 <li>"회사"의 정책 및 결제업체(이동통신사, 카드사 등)의 기준에 따라 "회원"의 결제수단별 월 누적 결제액 및 결제한도가 제한될 수 있습니다.</li>
					</ol>
				</div>
				<p class="list_title">제3장 선불전자지급수단의 발행 및 관리서비스</p>
				<div>
					<p class="list_title">제18조 (정의)</p>
					<ol>
						 <li>본 장에서 사용하는 용어의 정의는 다음과 같습니다.
							<ol>
								<li>(1) "선불전자지급수단"이라 함은 페이코 포인트 등 "회사"가 발행 당시 미리 "회원"에게 공지한 전자금융거래법상 선불전자지급수단을 말합니다.</li>
							</ol>
						 </li>
					</ol>
				</div>
				<div>
					<p class="list_title">제19조 (적용 범위)</p>
					<ol>
						 <li>(1)본 장에서 규정하고 있는 사항은 “회사”가 유상으로 발행한 “선불전자지급수단”에만 적용됩니다.</li>
						 <li>(2)“회원”이 “회사”가 발행한 “선불전자지급수단”으로 다른 형태의 상품권[공정거래위원회의 신유형 상품권 표준약관 제2조 제1항 각 호의 유형(전자형, 모바일, 온라인 상품권)이 아닌 것에 한함]을 구매한 경우 해당 상품권의 사용 및 환불 등에 관해서는 “회사”의 명시적인 표시가 없는 한 이 약관의 적용을 받지 않습니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제20조 ("접근매체"의 관리)</p>
					<ol>
						 <li>"회사"는 "회원"으로부터 "접근매체"의 분실 또는 도난 등의 통지를 받기 전에 발생하는 "선불전자지급수단"에 저장된 금액에 대한 손해에 대하여는 책임지지 않습니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제21조 (발행)</p>
					<ol>
						 <li>“회사”는 “선불전자지급수단”의 발행 시 소요되는 제반비용을 부담합니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제22조 (“선불전자지급수단”의 사용 등)</p>
					<ol>
						 <li>(1) "회원"은 "회사" 또는 “회사”의 가맹점에서 언제든지 “선불전자지급수단”을 사용할 수 있습니다. 다만, “회사”가 미리 본 약관, 서비스 정책, 서비스 페이지 등에서 표시한 경우, 특정 가맹점 또는 물품 등에 대하여 “선불전자지급수단”의 사용을 제한할 수 있습니다.</li>
						 <li>(2) “회원”은 잔액 범위 내에서 사용 횟수에 제한 없이 “선불전자지급수단”을 사용 할 수 있으며, 사용 시 사용 금액만큼 “선불전자지급수단”이 차감됩니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제23조 (환급 등)</p>
					<ol>
						 <li>(1) “회원”은 “선불전자지급수단” 구매 후 “회사”에 청약 철회 또는 환불을 신청할 수 있으며, 이 경우 “회사”는 “선불전자지급수단”에 기록된 잔액을 “회원”에게 지급합니다.</li>
						 <li>(2) “회사”는 “회원”이 “선불전자지급수단”의 구매 청약 철회 또는 환불을 신청할 경우 구매 금액 또는 잔액을 지급하기 위하여 필요한 비용을 수수료로 청구할 수 있습니다.</li>
						 <li>(3) “회사”는 제2항에 의한 수수료가 “회원”이 유상으로 구매한 “선불전자지급수단”에 기록된 잔액보다 많을 경우에는 “회원”의 환불청구를 제한 할 수 있습니다.</li>
						 <li>(4) 다음 각 호의 어느 하나에 해당하는 사유로 인하여 “회원”이 “선불전자지급수단” 잔액의 환급을 요청 하는 경우 “회사”는 “회원”의 “선불전자지급수단” 등을 회수하고 잔액 전부를 지급합니다. 이 경우 “회사”는 “회원”에게 환급 수수료를 청구 하지 않습니다.
							<ol>
								<li>① 천재지변 등의 사유로 가맹점이 물품 또는 용역을 제공하기가 곤란하여 “선불전자 지급수단”의 사용이 불가한 경우</li>
								<li>② “선불전자지급수단”의 결함으로 가맹점이 재화 또는 용역을 제공하지 못하게 된 경우</li>
							</ol>
						</li>
						<li>(5) “회사”가 “선불전자지급수단”의 유효기간을 소멸시효보다 짧게 정한 경우, “회원”은 유효기간 경과 후 소멸시효 경과 전까지 “회사”에게 “선불전자지급수단”의 미사용 부분에 대한 반환을 청구할 수 있으며, “회사”는 잔액의 90%를 “회원”에게 지급합니다.</li>
						<li>(6) “회사”에 환불을 요청할 수 있는 권리는 “선불전자지급수단”의 최종 소지자가 보유합니다. 다만, “선불전자지급수단” 최종 소지자가 “회사”에 환불을 요청할 수 없는 경우에 한하여 “선불전자지급수단” 구매자가 “회사”에 환불을 요청할 수 있으며 “회사”가 구매자에게 환불한 경우 “회사”는 환불에 관한 책임을 면합니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제24조 ("거래지시"의 철회)</p>
					<ol>
						 <li>(1) "회원"이 "선불전자지급수단"을 이용하여 자금을 지급하는 경우, "회원"은 "거래지시"된 금액의 정보가 수취인이 지정한 "전자적 장치"에 도달하기 전까지 "거래지시"를 철회할 수 있습니다.</li>
						 <li>(2) "회사"는 "회원"의 "거래지시"의 철회에 따라 지급거래가 이루어지지 않은 경우 수령한 자금을 "회원"에게 반환하여야 합니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제25조 ("선불전자지급수단"의 한도 등)</p>
					<ol>
						 <li>(1) "회사"는 "선불전자지급수단"에 대해 실지명의 당 최고 200만원을 그 보유 한도로 합니다. 단 보유 한도는 “회사”의 정책에 따라 감액될 수 있습니다.</li>
						 <li>(2) 제2장 전자지급결제대행서비스 제17조는 본 장에 준용합니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제26조 (유효기간 등)</p>
					<ol>
						 <li>(1) "회사"는 "회원"에 대하여 "선불전자지급수단"에 대한 유효기간을 설정할 수 있으며, "회원"은 "회사"가 정한 유효기간 내에서만 "선불전자지급수단"을 사용할 수 있습니다.</li>
						 <li>(2) "회사"는 서비스 페이지 등을 통하여 전 항의 유효기간 설정 여부 및 그 기간을 공지합니다. 단, “회사”가 유효기간을 달리 정하지 않은 경우에는 본조 제5항의 소멸시효기간을 유효기간으로 봅니다.</li>
						 <li>(3) “회사”가 유효기간을 소멸시효기간보다 짧게 정한 경우, “회원”은 “회사”에게 유효기간 내에서 유효기간의 연장을 요청할 수 있고, 요청을 받은 “회사”는 특별한 사유가 없는 한 소멸시효 기간 내에서 유효기간을 3개월 단위로 연장합니다.</li>
						 <li>(4) “회사”는 유효기간이 도래하기 7일전 통지를 포함하여 3회 이상 “회원”에게 유효기간의 도래, 유효기간의 연장 가능여부와 방법 등을 이메일 또는 문자메세지 등의 방법으로 통지합니다.</li>
						 <li>(5) “회사”가 발행한 “선불전자지급수단”은 충전일로부터 5년간 사용하지 않으면 소멸합니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제27조 (지급보증 등 체결 사항)</p>
					<ol>
						 <li>“회사”는 “선불전자지급수단”의 지급보증 또는 피해보상보험계약 대신 전자금융거래법에서 정한 보험 계약을 체결하였습니다.</li>
					</ol>
				</div>
				<p class="list_title">제4장 직불전자지급수단의 발행 및 관리서비스</p>
				<div>
					<p class="list_title">제28조 (정의)</p>
					본 장에서 사용하는 용어의 정의는 다음과 같습니다.
					<ol>
						 <li>(1) "직불전자지급수단"이라 함은 "회원"과 "판매자" 간에 전자적 방법에 따라 금융회사의 계좌에서 자금을 이체하는 방법으로 재화 등의 제공과 그 대가의 지급을 동시에 이행할 수 있는 전자금융거래법상 직불전자지급수단을 말합니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제29조 ("거래지시"의 철회)</p>
					<ol>
						 <li>(1) "회원"이 "직불전자지급수단"을 이용하여 자금을 지급하는 경우, "회원"은 "거래지시"된 금액의 정보에 대하여 수취인의 계좌가 개설되어 있는 금융회사의 계좌의 원장에 입금기록이 끝나기 전까지 "거래지시"를 철회할 수 있습니다.</li>
						 <li>(2) "회사"는 "회원"의 "거래지시"의 철회에 따라 지급거래가 이루어지지 않은 경우 수령한 자금을 "회원"에게 반환하여야 합니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제30조 ("직불전자지급수단"의 한도 등)</p>
					<ol>
						 <li>(1) "회사"는 "회원"이 "직불전자지급수단"을 이용하여 재화 등을 구매할 수 있는 최대 이용한도(1회, 1일 이용한도 등)를 관련 법령 및 "회사"의 정책에 따라 정할 수 있으며, "회원"은 "회사"가 정한 그 이용한도 내에서만 "직불전자지급수단"을 사용할 수 있습니다.</li>
						 <li>(2) "회사"는 서비스 페이지 등을 통하여 전 항의 최대 이용한도를 공지합니다.</li>
					</ol>
				</div>
				<p class="list_title">제5장 결제대금예치서비스</p>
				<div>
					<p class="list_title">제31조 (정의)</p>
					본 장에서 사용하는 용어의 정의는 다음과 같습니다.
					<ol>
						 <li>(1) "결제대금예치서비스"라 함은 서비스 페이지에서 이루어지는 "선불식 통신판매"에 있어서, "회사"가 "회원"이 지급하는 결제대금을 예치하고, 배송이 완료되는 등 구매가 확정된 후 재화 등의 대금을 "판매자"에게 지급하는 서비스를 말합니다.</li>
						 <li>(2) "선불식 통신판매"라 함은 "회원"이 재화 등을 공급받기 전에 미리 대금의 전부 또는 일부를 지급하는 방식의 통신판매를 말합니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제32조 (예치된 결제대금의 지급방법)</p>
					<ol>
						 <li>(1) "회원"(그 "회원"의 동의를 얻은 경우에는 재화 등을 공급받을 자를 포함합니다. 이하 제②항 및 제③항에서 동일합니다)은 재화 등을 공급받은 사실을 재화 등을 공급받은 날부터 3영업일 이내에 "회사"에 통보하여야 합니다.</li>
						 <li>(2) "회사"는 "회원"으로부터 재화 등을 공급받은 사실을 통보 받을 경우 "회사"가 정한 기일 내에 "판매자"에게 결제대금을 지급합니다.</li>
						 <li>(3) "회사"는 "회원"이 재화 등을 공급받은 날부터 3영업일이 지나도록 정당한 사유의 제시 없이 그 공급받은 사실을 "회사"에 통보하지 아니하는 경우에 "회원"의 동의 없이 "판매자"에게 결제대금을 지급할 수 있습니다.</li>
						 <li>(4) "회사"가 "판매자"에게 결제대금을 지급하기 전에 "회원"이 그 결제대금을 환급 받을 정당한 사유가 발생한 경우에는 그 결제대금을 "회원"에게 환급합니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제 33조("거래지시"의 철회)</p>
					<ol>
						 <li>(1) "회원"이 "결제대금예치서비스"를 이용한 경우, "회원"은 "거래지시"된 금액의 정보“”에 대하여 수취인의 계좌가 개설되어 있는 금융회사 또는 “회사”의 계좌의 원장에 입금기록이 끝나거나, “전자적 장치”에 입력이 끝나기 전까지 “거래지시”를 철회할 수 있습니다.</li>
						 <li>(2) "회사"는 "회원"의 “거래지시”의 철회에 따라 지급거래가 이루어지지 않은 경우 수령한 자금을 "회원"에게 반환하여야 합니다.</li>
					</ol>
				</div>
				<p class="list_title">제6장 전자고지결제서비스</p>
				<div>
					<p class="list_title">제34조 (정의)</p>
					본 장에서 사용하는 용어의 정의는 다음과 같습니다.
					<ol>
						 <li>(1) "전자고지결제서비스"라 함은 국세, 지방세, 공공요금, 각종 지로요금 등의 지급과 관련하여 "청구서"등의 전자적인 방법으로 자금 내역을 고지하고, 이를 수수하여 그 정산을 대행하는 업무를 제공하는 시스템 및 서비스 일체를 말합니다.</li>
						 <li>(2) "청구서"라 함은 "회사"가 수취인을 대행하여 지급인에게 전송하는 전자적인 방식의 고지방법을 말합니다.</li>
					</ol>
				</div>
				<div>
					<p class="list_title">제35조 ("거래지시"의 철회)</p>
					<ol>
						 <li>(1) "회원"이 "전자고지결제서비스"를 이용한 경우, “회원”은 “거래지시”된 금액의 정보에 대하여 수취인의 계좌가 개설되어 있는 금융회사 또는 “회사”의 계좌의 원장에 입금기록이 끝나거나 “전자적 장치”에 입력이 끝나기 전까지 "거래지시"를 철회할 수 있습니다.</li>
						 <li>(2) "회사"는 "회원"의 "거래지시"의 철회에 따라 지급거래가 이루어지지 않은 경우 수령한 자금을 "회원"에게 반환하여야 합니다.</li>
					</ol>
				</div>
				<div>
					<ol>
						 <li>&lt;부칙&gt; 본 약관은 2018년 7월 1일부터 적용됩니다.</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
<?php
	include_once(G5_PATH."/tail.php");
?>