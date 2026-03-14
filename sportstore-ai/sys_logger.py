import logging
import sys
from colorama import init, Fore, Style

# Khởi tạo colorama để fix màu cho Windows/Mac
init(autoreset=True)

class ColoredFormatter(logging.Formatter):
    """
    Tùy chỉnh định dạng log format để tự động đổi màu text theo chuẩn ERROR, WARNING, INFO.
    """
    format_str = "%(asctime)s | %(levelname)-7s | %(message)s"
    datefmt = "%H:%M:%S"

    COLORS = {
        logging.DEBUG: Fore.CYAN,
        logging.INFO: Fore.GREEN,
        logging.WARNING: Fore.YELLOW,
        logging.ERROR: Fore.RED,
        logging.CRITICAL: Fore.RED + Style.BRIGHT
    }

    def format(self, record):
        log_fmt = self.COLORS.get(record.levelno, Fore.WHITE) + self.format_str + Style.RESET_ALL
        formatter = logging.Formatter(log_fmt, datefmt=self.datefmt)
        return formatter.format(record)

def setup_logger(name="SportStore-AI"):
    logger = logging.getLogger(name)
    logger.setLevel(logging.INFO)
    
    # Xóa các handler cũ nếu có
    if logger.hasHandlers():
        logger.handlers.clear()

    # 1. Console Handler (In ra Terminal)
    console_handler = logging.StreamHandler(sys.stdout)
    console_handler.setLevel(logging.INFO)
    console_handler.setFormatter(ColoredFormatter())
    logger.addHandler(console_handler)

    return logger

# Tạo instance logger dùng chung
log = setup_logger()

# Hàm log nổi bật riêng cho AI Event
def log_ai(event, message):
    print(f"{Fore.MAGENTA}{Style.BRIGHT}[AI ENGINE] {event}:{Style.RESET_ALL} {Fore.WHITE}{message}")
