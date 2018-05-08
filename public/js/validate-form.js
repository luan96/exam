(function ($) {

  $(document).ready(function () {
    $('#form-login').validate({
      rules: {
        'username': {
          required: true,
          rangelength: [2, 15]
        },
        'password': {
          required: true,
          rangelength: [2, 15]
        }
      },
      messages: {
        username: {
          required: "Vui lòng nhập Username",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự."
        },
        password: {
          required: "Vui lòng nhập password.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự."
        }
      }

    });
    $('#form-signin').validate({
      rules: {
        'username': {
          required: true,
          rangelength: [2, 15]
        },
        'password': {
          required: true,
          rangelength: [2, 15]
        },
        'password_confirmation': {
          required: true,
          rangelength: [2, 15],
          equalTo: "#password"
        },
        'name': {
          required: true,
          rangelength: [2, 20]
        },
        avatar: {
          required: true,
          extension: "jpg|jpeg|bmp|gif|png"
        },
      },
      messages: {
        username: {
          required: "Vui lòng nhập Username.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự."
        },
        password: {
          required: "Vui lòng nhập Password.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự."
        },
        password_confirmation: {
          required: "Vui lòng nhập Password.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự.",
          equalTo: "Mật khẩu không khớp."
        },
        name: {
          required: "Vui lòng nhập name.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự."
        },
        avatar: {
          required: "Vui lòng nhập avatar.",
          extension: "Hãy nhập đúng định dạng image (jpg, jpeg, bmp, gif, png)."
        }
      }

    });
    $('#form-create-user').validate({
      rules: {
        'username': {
          required: true,
          rangelength: [2, 15]
        },
        'password': {
          required: true,
          rangelength: [2, 15]
        },
        'password_confirmation': {
          required: true,
          rangelength: [2, 15],
          equalTo: "#password"
        },
        'name': {
          required: true,
          rangelength: [2, 20]
        },
        avatar: {
          required: true,
          extension: "jpg|jpeg|bmp|gif|png"
        }
      },
      messages: {
        username: {
          required: "Vui lòng nhập Username.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự."
        },
        password: {
          required: "Vui lòng nhập Password.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự."
        },
        password_confirmation: {
          required: "Vui lòng nhập Password.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự.",
          equalTo: "Mật khẩu không khớp."
        },
        name: {
          required: "Vui lòng nhập name.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự."
        },
        avatar: {
          required: "Vui lòng nhập avatar.",
          extension: "Hãy nhập đúng định dạng image (jpg, jpeg, bmp, gif, png)."
        }
      }

    });
    $('#form-edit-user').validate({
      rules: {
        'username': {
          required: true,
          rangelength: [2, 15]
        },
        'password': {
          required: true,
          rangelength: [2, 15]
        },
        'password_confirmation': {
          required: true,
          rangelength: [2, 15],
          equalTo: "#password"
        },
        'name': {
          required: true,
          rangelength: [2, 20]
        },
        avatar: {
          required: true,
          extension: "jpg|jpeg|bmp|gif|png"
        }
      },
      messages: {
        username: {
          required: "Vui lòng nhập Username.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự."
        },
        password: {
          required: "Vui lòng nhập Password.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự."
        },
        password_confirmation: {
          required: "Vui lòng nhập Password.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự.",
          equalTo: "Mật khẩu không khớp."
        },
        name: {
          required: "Vui lòng nhập name.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự."
        },
        avatar: {
          required: "Vui lòng nhập avatar.",
          extension: "Hãy nhập đúng định dạng image (jpg, jpeg, bmp, gif, png)."
        }
      }

    });
    $('#form-sua-user').validate({
      rules: {
        'password': {
          required: true,
          rangelength: [2, 15]
        },
        'password_confirmation': {
          required: true,
          rangelength: [2, 15],
          equalTo: "#password"
        },
        'name': {
          required: true,
          rangelength: [2, 20]
        },
        'avatar': {
          required: true,
          extension: "jpg|jpeg|bmp|gif|png"
        }
      },
      messages: {
        password: {
          required: "Vui lòng nhập Password.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự."
        },
        password_confirmation: {
          required: "Vui lòng nhập Password.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự.",
          equalTo: "Mật khẩu không khớp."
        },
        name: {
          required: "Vui lòng nhập Tên.",
          rangelength: "Hãy nhập từ 2 đến 15 ký tự."
        },
        avatar: {
          required: "Vui lòng nhập Avatar.",
          extension: "Hãy nhập đúng định dạng Image."
        }
      }

    });
    $('#form-create-kythi').validate({
      rules: {
        'name': {
          required: true
        },
        'begin': {
          required: true,
        },
        'end': {
          required: true,
        },
        'thoigianthi': {
          required: true,
          digits: true
        },
        'diemdat': {
          required: true,
          digits: true
        }
      },
      messages: {
        name: {
          required: "Vui lòng nhập Tên."
        },
        begin: {
          required: "Vui lòng nhập Thời gian Bắt đầu."
        },
        end: {
          required: "Vui lòng nhập Thời gian Kết thúc."
        },
        thoigianthi: {
          required: "Vui lòng nhập Thời gian Thi.",
          digits: "Vui lòng nhập Số nguyên."
        },
        diemdat: {
          required: "Vui lòng nhập Điểm đạt.",
          digits: "Vui lòng nhập Số nguyên."
        }
      }

    });
    $('#form-edit-kythi').validate({
      rules: {
        'name': {
          required: true
        },
        'begin': {
          required: true,
        },
        'end': {
          required: true,
        },
        'thoigianthi': {
          required: true,
          digits: true
        },
        'diemdat': {
          required: true,
          digits: true
        },
      },
      messages: {
        name: {
          required: "Vui lòng nhập Tên."
        },
        begin: {
          required: "Vui lòng nhập Thời gian Bắt đầu."
        },
        end: {
          required: "Vui lòng nhập Thời gian Kết thúc."
        },
        thoigianthi: {
          required: "Vui lòng nhập Thời gian Thi.",
          digits: "Vui lòng nhập Số nguyên."
        },
        diemdat: {
          required: "Vui lòng nhập Điểm đạt.",
          digits: "Vui lòng nhập Số nguyên."
        }
      }

    });
    $('#form-create-dethi').validate({
      rules: {
        'name': {
          required: true
        },
        'mon': {
          required: true,
        },
        'phanloai': {
          required: true,
        }
      },
      messages: {
        name: {
          required: "Vui lòng nhập Tên."
        },
        mon: {
          required: "Vui lòng nhập Môn."
        },
        phanloai: {
          required: "Vui lòng nhập Loại."
        }
      }

    });
    $('#form-edit-dethi').validate({
      rules: {
        'name': {
          required: true
        }
      },
      messages: {
        name: {
          required: "Vui lòng nhập Tên."
        }
      }

    });
    $('#form-create-cauhoi').validate({
      rules: {
        'mon': {
          required: true
        },
        'phanloai': {
          required: true
        },
        'noidung': {
          required: true
        },
        'diem': {
          required: true,
          digits: true
        },
        'phuongan': {
          required: true
        }
      },
      messages: {
        mon: {
          required: "Vui lòng nhập Môn."
        },
        phanloai: {
          required: "Vui lòng nhập Loại."
        },
        noidung: {
          required: "Vui lòng nhập Nội dung."
        },
        diem: {
          required: "Vui lòng nhập Điểm.",
          digits: "Vui lòng nhập Số nguyên."
        },
        phuongan: {
          required: "Vui lòng nhập Phương án."
        }
      }

    });
    $('#form-edit-cauhoi').validate({
      rules: {
        'mon': {
          required: true
        },
        'phanloai': {
          required: true
        },
        'noidung': {
          required: true
        },
        'diem': {
          required: true,
          digits: true
        },
        'phuongan': {
          required: true
        }
      },
      messages: {
        mon: {
          required: "Vui lòng nhập Môn."
        },
        phanloai: {
          required: "Vui lòng nhập Loại."
        },
        noidung: {
          required: "Vui lòng nhập Nội dung."
        },
        diem: {
          required: "Vui lòng nhập Điểm.",
          digits: "Vui lòng nhập Số nguyên."
        },
        phuongan: {
          required: "Vui lòng nhập Phương án."
        }
      }

    });
    $('#form-create-mon').validate({
      rules: {
        'name': {
          required: true
        }
      },
      messages: {
        name: {
          required: "Vui lòng nhập Tên."
        }
      }

    });
    $('#form-edit-mon').validate({
      rules: {
        'name': {
          required: true
        }
      },
      messages: {
        name: {
          required: "Vui lòng nhập Tên."
        }
      }

    });
    $('#form-create-phongthi').validate({
      rules: {
        'name': {
          required: true
        },
        'ip_begin': {
          required: true
        },
        'ip_end': {
          required: true
        }
      },
      messages: {
        name: {
          required: "Vui lòng nhập Tên."
        },
        ip_begin: {
          required: "Vui lòng nhập IP bắt đầu."
        },
        ip_end: {
          required: "Vui lòng nhập IP kết thúc."
        }
      }

    });
    $('#form-edit-phongthi').validate({
      rules: {
        'name': {
          required: true
        },
        'ip_begin': {
          required: true
        },
        'ip_end': {
          required: true
        }
      },
      messages: {
        name: {
          required: "Vui lòng nhập Tên."
        },
        ip_begin: {
          required: "Vui lòng nhập IP bắt đầu."
        },
        ip_end: {
          required: "Vui lòng nhập IP kết thúc."
        }
      }

    });

  });

})(jQuery);