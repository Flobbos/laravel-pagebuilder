const CONSTANT = {
  DEFAULT_TYPE: 'info',
  DEFAULT_BTN_CLOSE_TEXT: 'Close',
  DEFAULT_BTN_CONFIRM_TEXT: 'Confirm',
  INVALID_TYPE: 'INVALID_TYPE'
}

export default {
  name: 'simplertConfig',
  config: {
    show: false,
    showSimplert: false,
    title: '',
    message: '',
    type: CONSTANT.DEFAULT_TYPE, // info (default), success, warning, error
    customClass: '',
    customIconUrl: '',
    onOpen: null,
    customCloseBtnText: CONSTANT.DEFAULT_BTN_CLOSE_TEXT,
    customCloseBtnClass: '',
    onClose: null,
    useConfirmBtn: false,
    customConfirmBtnText: CONSTANT.DEFAULT_BTN_CONFIRM_TEXT,
    customConfirmBtnClass: '',
    onConfirm: null,
    disableOverlayClick: false,
    hideAllButton: false,
    showXclose: false
  },
  defaultCons: CONSTANT
}
