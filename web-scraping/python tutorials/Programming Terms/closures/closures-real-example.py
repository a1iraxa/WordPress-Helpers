import logging

logging.basicConfig(filename="closure-log.log", level=logging.INFO)

def add(x, y):
	return x + y

def subtraction(x, y):
	return x - y


def logger(func):

	def log_me(*args):

		logging.info( f'Running {func.__name__}() with arguments {args}' );

		print( func(*args) )

	return log_me


add_logger = logger(add)
subtraction_logger = logger(subtraction)
add_logger(2,6)
subtraction_logger(2,6)
add_logger(6,6)
subtraction_logger(6,6)