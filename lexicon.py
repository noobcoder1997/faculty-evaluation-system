from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer
import sys
info = sys.argv[1]
data = [info.replace("_", " ")]
analyser = SentimentIntensityAnalyzer()
output = analyser.polarity_scores(data)
print(output)
